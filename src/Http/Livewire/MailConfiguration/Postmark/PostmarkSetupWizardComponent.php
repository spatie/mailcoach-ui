<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Postmark;

use Livewire\Livewire;
use Spatie\LivewireWizard\Components\WizardComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Postmark\Steps\AuthenticationStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Postmark\Steps\FeedbackStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Postmark\Steps\MessageStreamStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Postmark\Steps\SummaryStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Postmark\Steps\ThrottlingStepComponent;
use Spatie\MailcoachUi\Models\Mailer;

class PostmarkSetupWizardComponent extends WizardComponent
{
    public Mailer $mailer;

    public function mount()
    {
        if ($this->mailer->isReadyForUse()) {
            $this->currentStepName = 'mailcoach-ui::postmark-summary-step';
        }
    }

    public function initialState(): ?array
    {
        return [
            'mailcoach-ui::postmark-summary-step' => [
                'mailerId' => $this->mailer->id,
            ],
        ];
    }

    public function steps(): array
    {
        return [
            AuthenticationStepComponent::class,
            MessageStreamStepComponent::class,
            ThrottlingStepComponent::class,
            FeedbackStepComponent::class,
            SummaryStepComponent::class,
        ];
    }

    public static function registerLivewireComponents(): void
    {
        Livewire::component('mailcoach-ui::postmark-configuration', PostmarkSetupWizardComponent::class);

        Livewire::component('mailcoach-ui::postmark-authentication-step', AuthenticationStepComponent::class);
        Livewire::component('mailcoach-ui::postmark-message-stream-step', MessageStreamStepComponent::class);
        Livewire::component('mailcoach-ui::postmark-throttling-step', ThrottlingStepComponent::class);
        Livewire::component('mailcoach-ui::postmark-feedback-step', FeedbackStepComponent::class);
        Livewire::component('mailcoach-ui::postmark-summary-step', SummaryStepComponent::class);
    }
}
