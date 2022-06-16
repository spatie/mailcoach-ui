<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Ses;

use Livewire\Livewire;
use Spatie\LivewireWizard\Components\WizardComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Ses\Steps\AuthenticationStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Ses\Steps\FeedbackStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Ses\Steps\SummaryStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\ThrottlingStepComponent;
use Spatie\MailcoachUi\Models\Mailer;

class SesSetupWizardComponent extends WizardComponent
{
    public Mailer $mailer;

    public function mount()
    {
        if ($this->mailer->isReadyForUse()) {
            $this->currentStepName = 'mailcoach-ui::ses-summary-step';
        }
    }

    public function initialState(): ?array
    {
        return [
            'mailcoach-ui::ses-summary-step' => [
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
        Livewire::component('mailcoach-ui::ses-configuration', SesSetupWizardComponent::class);
        Livewire::component('mailcoach-ui::ses-authentication-step', AuthenticationStepComponent::class);
        Livewire::component('mailcoach-ui::ses-throttling-step', ThrottlingStepComponent::class);
        Livewire::component('mailcoach-ui::ses-feedback-step', FeedbackStepComponent::class);
        Livewire::component('mailcoach-ui::ses-summary-step', SummaryStepComponent::class);
    }
}
