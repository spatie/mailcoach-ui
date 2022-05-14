<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class ThirdStepComponent extends StepComponent
{
    protected string $text = 'a bit of state';

    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.third');
    }

    public function info(): array
    {
        return [
            'label' => 'My third step',
        ];
    }
}
