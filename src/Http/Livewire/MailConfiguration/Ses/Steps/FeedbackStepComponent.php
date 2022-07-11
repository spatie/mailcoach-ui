<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Ses\Steps;

use Exception;
use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSesFeedback\SesWebhookController;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Concerns\UsesMailer;

class FeedbackStepComponent extends StepComponent
{
    use LivewireFlash;
    use UsesMailer;

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

        try {
            $mailCoachSes
                ->ensureValidAwsCredentials()
                ->deleteConfigurationSet()
                ->deleteSnsTopic()
                ->createConfigurationSet()
                ->createSnsTopic()
                ->createSnsSubscription()
                ->addSnsSubscriptionToSesTopic();
        } catch (Exception $e) {
            $this->flashError('Something went wrong while setting up SES feedback');
            $this->addError('configurationName', $e->getMessage());
            return;
        }

        $this->mailer()->merge([
            'ses_configuration_set' => $this->configurationName,
            'open_tracking_enabled' => $this->trackOpens,
            'click_tracking_enabled' => $this->trackClicks,
        ]);

        $this->mailer()->markAsReadyForUse();

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
        return view('mailcoach-ui::app.configuration.mailers.wizards.ses.feedback');
    }

    protected function getMailcoachSes(): MailcoachSes
    {
        $endpoint = action(SesWebhookController::class);

        $sesConfig = new MailcoachSesConfig(
            $this->mailer()->get('ses_key'),
            $this->mailer()->get('ses_secret'),
            $this->mailer()->get('ses_region'),
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
