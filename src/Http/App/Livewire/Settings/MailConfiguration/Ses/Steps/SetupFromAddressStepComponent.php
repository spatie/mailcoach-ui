<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;

class SetupFromAddressStepComponent extends StepComponent
{
    public array $rules = [
        'email' => 'required|email',
    ];

    public ?string $email = '';

    public function submit()
    {
        $this->validate();

        $mailcoachSes = $this->getMailcoachSes();

        $mailcoachSes->createSesIdentity($this->email);

        $this->nextStep();
    }

    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.ses.setupFromAddress');
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Setup From Address',
        ];
    }

    protected function getMailcoachSes(): MailcoachSes
    {
        ray($this->allStepsState());

        $credentials = $this->allStepsState('mailcoach-ui::ses-authentication-step');

        $sesConfig = new MailcoachSesConfig(
            $credentials['key'],
            $credentials['secret'],
            $credentials['region'],
        );

        return new MailcoachSes($sesConfig);
    }
}
