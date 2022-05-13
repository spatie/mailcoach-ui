<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\MailcoachUi\Support\LivewireWizard\Step;

class SecondStep extends Step
{
    public array $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
    ];

    public string $myValue = 'second step value';

    public function increment()
    {
        $this->wizard->counter = $this->wizard->counter + 1;
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
}
