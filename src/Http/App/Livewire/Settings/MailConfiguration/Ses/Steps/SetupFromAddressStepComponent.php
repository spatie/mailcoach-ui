<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class SetupFromAddressStepComponent extends StepComponent
{
    public array $rules = [
        'email' => 'required|email',
    ];

    public string $email;

    public function submit()
    {
        $this->validate();

        // verify email
    }

    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.ses.setupFromAddress');
    }

    public function info(): array
    {
        return [
            'label' => 'Setup From Address',
        ];
    }
}
