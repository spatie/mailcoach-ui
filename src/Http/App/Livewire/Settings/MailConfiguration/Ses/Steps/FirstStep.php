<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\MailcoachUi\Support\LivewireWizard\Step;

class FirstStep extends Step
{
    public string $myValue = 'first step value';

    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.first');
    }
}
