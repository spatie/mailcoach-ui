<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfiguration;

class SetupFromAddressStepComponent extends StepComponent
{
    use LivewireFlash;

    public array $rules = [
        'email' => 'required|email',
    ];

    public ?string $email = '';

    public function mount()
    {
        $this->email = app(MailConfiguration::class)->get('default_from_mail');
    }

    public function submit()
    {
        $this->validate();

        $mailcoachSes = $this->getMailcoachSes();

        $mailcoachSes->createSesIdentity();

        app(MailConfiguration::class)->merge([
            'default_from_mail' => $this->email,
        ]);

        $this->flash('The from address was saved.');

        $this->nextStep();
    }

    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.ses.setupFromAddress');
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'From Address',
        ];
    }

    protected function getMailcoachSes(): MailcoachSes
    {
        $credentials = $this->allStepsState('mailcoach-ui::ses-authentication-step');

        $sesConfig =  new MailcoachSesConfig(
            $credentials['key'],
            $credentials['secret'],
            $credentials['region'],
        );

        return new MailcoachSes($sesConfig);
    }
}
