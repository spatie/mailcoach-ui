<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSendgridFeedback\SendgridEvents\SendgridEvent;
use Spatie\MailcoachSendgridFeedback\SendgridWebhookController;
use Spatie\MailcoachSendgridSetup\EventType;
use Spatie\MailcoachSendgridSetup\Sendgrid;
use Spatie\MailcoachSesFeedback\SesWebhookController;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Concerns\UsesMailer;

class FeedbackStepComponent extends StepComponent
{
    use LivewireFlash;
    use UsesMailer;

    public bool $trackOpens = true;
    public bool $trackClicks = true;

    public array $rules = [
        'trackOpens' => ['boolean'],
        'trackClicks' => ['boolean'],

    ];

    public function configureSendGrid()
    {
        $this->validate();

        $endpoint = action(SendgridWebhookController::class);

        // debug
        $endpoint = 'https://spatie.be/sendgrid-feedback';


$events = [EventType::Bounce, EventType::Bounce];

        if ($this->trackOpens) {
            $events[] = EventType::Open;
        }

        if ($this->trackClicks) {
            $events[] = EventType::Click;
        }

        $this->getSendGrid()->setupWebhook($endpoint, $events);

        $this->mailer()->merge([
            'open_tracking_enabled' => $this->trackOpens,
            'click_tracking_enabled' => $this->trackClicks,
        ]);

        $this->mailer()->markAsReadyForUse();

        $this->flash('Your account has been configured to handle feedback.');

        $this->nextStep();
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.sendGrid.feedback');
    }

    protected function getSendGrid(): Sendgrid
    {
        $state = $this->state()->forStep('mailcoach-ui::sendgrid-authentication-step');

        return new Sendgrid($state['apiKey']);
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Feedback',
        ];
    }
}
