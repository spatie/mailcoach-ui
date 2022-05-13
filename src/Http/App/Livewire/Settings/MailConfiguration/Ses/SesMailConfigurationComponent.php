<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses;

use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\FirstStep;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\SecondStep;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\ThirdStep;
use Spatie\MailcoachUi\Support\LivewireWizard\WizardComponent;

class SesMailConfigurationComponent extends WizardComponent
{
    public int $counter = 0;

    public $name;
    public $email;

    public array $rules = [];

    public function steps(): array
    {
        return [
            new FirstStep(),
            new SecondStep(),
            new ThirdStep(),
        ];
    }
}
