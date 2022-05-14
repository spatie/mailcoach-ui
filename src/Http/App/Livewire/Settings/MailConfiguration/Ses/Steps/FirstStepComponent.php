<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;


use Spatie\LivewireWizard\StepComponent;

class FirstStepComponent extends StepComponent
{
    public string $myValue = 'first step value';

    public function something()
    {
        $this->myValue = 'myValue';
    }

    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.first');
    }
}
