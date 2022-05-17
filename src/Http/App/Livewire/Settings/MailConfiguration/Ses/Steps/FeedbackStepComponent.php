<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSesFeedback\SesWebhookController;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;

class FeedbackStepComponent extends StepComponent
{
    use LivewireFlash;

    public string $configurationType = 'automatic';
    public string $configurationName = 'mailcoach';

    public bool $trackOpens = true;
    public bool $trackClicks = true;

    public array $rules = [
        'configurationName' => ['required'],
    ];

    public function setupFeedbackAutomatically()
    {
        $this->validate();

        $mailCoachSes = $this->getMailcoachSes();

        $mailCoachSes
            ->ensureValidAwsCredentials()
            ->deleteConfigurationSet()
            ->deleteSnsTopic()
            ->createConfigurationSet()
            ->createSnsTopic()
            ->createSnsSubscription()
            ->addSnsSubscriptionToSesTopic();

        $this->flash('Your account has been configured to handle feedback.');

        $this->nextStep();
    }

    public function setupFeedbackManually()
    {
        $this->validate();

        $this->nextStep();

        $this->flash('The settings have been saved.');
    }


    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.ses.feedback');
    }

    protected function getMailcoachSes(): MailcoachSes
    {
        $credentials = $this->allStepsState('mailcoach-ui::ses-authentication-step');

        $endpoint = action(SesWebhookController::class);

        // debug
        $endpoint = 'https://spatie.be/ses-feedback';

        $sesConfig = new MailcoachSesConfig(
            $credentials['key'],
            $credentials['secret'],
            $credentials['region'],
            $endpoint,
        );

        $sesConfig->setConfigurationName($this->configurationName);

        if ($this->trackOpens) {
            $sesConfig->enableOpenTracking();
        }

        if ($this->trackClicks) {
            $sesConfig->enableClickTracking();
        }

        return new MailcoachSes($sesConfig);
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Feedback',
        ];
    }
}
