<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid;

use Spatie\LivewireWizard\Components\WizardComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid\Steps\AuthenticationStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid\Steps\SummaryStepComponent;

class SendGridSetupWizardComponent extends WizardComponent
{
    public function steps(): array
    {
        return [
            AuthenticationStepComponent::class,
            SummaryStepComponent::class,
        ];
    }
}
