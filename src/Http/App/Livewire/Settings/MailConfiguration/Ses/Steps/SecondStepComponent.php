<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

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
        return view('mailcoach-ui::app.drivers.campaigns.livewire.second');
    }

    public function info(): array
    {
        return [
            'label' => 'My second step',
        ];
    }
}
