<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid;

use Livewire\Livewire;
use Spatie\LivewireWizard\Components\WizardComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid\Steps\AuthenticationStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid\Steps\FeedbackStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid\Steps\SummaryStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid\Steps\ThrottlingStepComponent;
use Spatie\MailcoachUi\Models\Mailer;

class SendGridSetupWizardComponent extends WizardComponent
{
    public Mailer $mailer;

    public function mount()
    {
        if ($this->mailer->isReadyForUse()) {
            $this->currentStepName = 'mailcoach-ui::sendgrid-summary-step';
        }
    }

    public function initialState(): ?array
    {
        return [
            'mailcoach-ui::sendgrid-summary-step' => [
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
        Livewire::component('mailcoach-ui::sendgrid-configuration', SendGridSetupWizardComponent::class);

        Livewire::component('mailcoach-ui::sendgrid-authentication-step', AuthenticationStepComponent::class);
        Livewire::component('mailcoach-ui::sendgrid-throttling-step', ThrottlingStepComponent::class);
        Livewire::component('mailcoach-ui::sendgrid-feedback-step', FeedbackStepComponent::class);
        Livewire::component('mailcoach-ui::sendgrid-summary-step', SummaryStepComponent::class);
    }
}
