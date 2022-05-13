<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\MailcoachUi\Support\LivewireWizard\Step;

class ThirdStep extends Step
{
    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.third');

    }
}
