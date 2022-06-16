<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Postmark\Steps;

use Illuminate\Support\Str;
use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachPostmarkFeedback\PostmarkWebhookController;
use Spatie\MailcoachPostmarkSetup\Enums\PostMarkTrigger;
use Spatie\MailcoachPostmarkSetup\Postmark;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Concerns\UsesMailer;

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

    public function configurePostmark()
    {
        $this->validate();

        $endpoint = action(PostmarkWebhookController::class);

        $events = [PostMarkTrigger::Bounce, PostMarkTrigger::SpamComplaint];

        if ($this->trackOpens) {
            $events[] = PostMarkTrigger::Open;
        }

        if ($this->trackClicks) {
            $events[] = PostMarkTrigger::Click;
        }

        $secret = Str::random(20);

        $this->getPostmark()->configureWebhook(
            url: $endpoint,
            streamId: $this->mailer()->get('streamId'),
            triggers: $events,
            secret: $secret
        );

        $this->mailer()->merge([
            'open_tracking_enabled' => $this->trackOpens,
            'click_tracking_enabled' => $this->trackClicks,
            'signing_secret' => $secret,
        ]);

        $this->mailer()->markAsReadyForUse();

        $this->flash('Your account has been configured to handle feedback.');

        $this->nextStep();
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.postmark.feedback');
    }

    protected function getPostmark(): Postmark
    {
        return new Postmark($this->mailer()->get('apiKey'));
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Feedback',
        ];
    }
}
