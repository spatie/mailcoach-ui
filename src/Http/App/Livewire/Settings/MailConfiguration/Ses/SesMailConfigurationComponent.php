<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses;

use Spatie\LivewireWizard\Components\WizardComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\AuthenticationStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\SecondStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\ThirdStepComponent;

class SesMailConfigurationComponent extends WizardComponent
{
    public function steps(): array
    {
        return [
            AuthenticationStepComponent::class,
        ];
    }
}
