<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses;

use Spatie\LivewireWizard\Components\WizardComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\AuthenticationStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\SetupFromAddressStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\SummaryStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\ThrottlingStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\FeedbackStepComponent;

class SesMailConfigurationComponent extends WizardComponent
{
    public function steps(): array
    {
        return [
            AuthenticationStepComponent::class,
            SetupFromAddressStepComponent::class,
            FeedbackStepComponent::class,
            ThrottlingStepComponent::class,
            SummaryStepComponent::class,
        ];
    }
}
