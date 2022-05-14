<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\StepComponent;

class SecondStepComponent extends StepComponent
{
    public array $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
    ];

    public string $myValue = 'second step value';

    public $name;

    public $email;

    public int $count = 0;

    public function increment()
    {
        $this->count = $this->count + 1;
    }

    public function submit()
    {
        $this->validate();

        $this->increment();
    }

    public function render()
    {
        ray($this->allStepsState());

        return view('mailcoach-ui::app.drivers.campaigns.livewire.second');
    }
}
