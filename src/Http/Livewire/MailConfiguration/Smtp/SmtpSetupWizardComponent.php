<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Smtp;

use Livewire\Livewire;
use Spatie\LivewireWizard\Components\WizardComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Smtp\Steps\SmtpSettingsStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Smtp\Steps\SummaryStepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Smtp\Steps\ThrottlingStepComponent;
use Spatie\MailcoachUi\Models\Mailer;

class SmtpSetupWizardComponent extends WizardComponent
{
    public Mailer $mailer;

    public function mount()
    {
        if ($this->mailer->isReadyForUse()) {
            $this->currentStepName = 'mailcoach-ui::smtp-summary-step';
        }
    }

    public function initialState(): ?array
    {
        return [
            'mailcoach-ui::smtp-summary-step' => [
                'mailerId' => $this->mailer->id,
            ],
        ];
    }

    public function steps(): array
    {
        return [
            SmtpSettingsStepComponent::class,
            ThrottlingStepComponent::class,
            SummaryStepComponent::class,
        ];
    }

    public static function registerLivewireComponents(): void
    {
        Livewire::component('mailcoach-ui::smtp-configuration', SmtpSetupWizardComponent::class);

        Livewire::component('mailcoach-ui::smtp-settings-step', SmtpSettingsStepComponent::class);
        Livewire::component('mailcoach-ui::smtp-throttling-step', ThrottlingStepComponent::class);
        Livewire::component('mailcoach-ui::smtp-summary-step', SummaryStepComponent::class);
    }
}
