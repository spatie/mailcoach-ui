<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Mailgun;

use Livewire\Livewire;
use Spatie\LivewireWizard\Components\WizardComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Mailgun\Steps\AuthenticationStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Mailgun\Steps\FeedbackStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Mailgun\Steps\SummaryStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\ThrottlingStepComponent;
use Spatie\MailcoachUi\Models\Mailer;

class MailgunSetupWizardComponent extends WizardComponent
{
    public Mailer $mailer;

    public function mount()
    {
        if ($this->mailer->isReadyForUse()) {
            $this->currentStepName = 'mailcoach-ui::mailgun-summary-step';
        }
    }

    public function initialState(): ?array
    {
        return [
            'mailcoach-ui::mailgun-summary-step' => [
                'mailerId' => $this->mailer->id,
            ],
        ];
    }

    public function steps(): array
    {
        return [
            AuthenticationStepComponent::class,
            ThrottlingStepComponent::class,
            FeedbackStepComponent::class,
            SummaryStepComponent::class,
        ];
    }

    public static function registerLivewireComponents(): void
    {
        Livewire::component('mailcoach-ui::mailgun-configuration', MailgunSetupWizardComponent::class);

        Livewire::component('mailcoach-ui::mailgun-authentication-step', AuthenticationStepComponent::class);
        Livewire::component('mailcoach-ui::mailgun-throttling-step', ThrottlingStepComponent::class);
        Livewire::component('mailcoach-ui::mailgun-feedback-step', FeedbackStepComponent::class);
        Livewire::component('mailcoach-ui::mailgun-summary-step', SummaryStepComponent::class);
    }
}
