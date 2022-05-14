<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses;

use Spatie\LivewireWizard\WizardComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\FirstStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\SecondStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\ThirdStepComponent;

class SesMailConfigurationComponent extends WizardComponent
{
    public function steps(): array
    {
        return [
            FirstStepComponent::class,
            SecondStepComponent::class,
            ThirdStepComponent::class,
        ];
    }
}
