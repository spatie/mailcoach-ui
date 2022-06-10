<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Concerns\UsesMailer;

class SetupFromAddressStepComponent extends StepComponent
{
    use LivewireFlash;
    use UsesMailer;

    public array $rules = [
        'email' => 'required|email',
    ];

    public ?string $email = '';

    public function mount()
    {
        $this->email = $this->mailer()->get('default_from_mail');
    }

    public function submit()
    {
        $this->validate();

        $mailcoachSes = $this->getMailcoachSes();

        $mailcoachSes->createSesIdentity();

        $this->mailer()->merge([
            'default_from_mail' => $this->email,
        ]);

        $this->flash('The from address was saved.');

        $this->nextStep();
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.ses.setupFromAddress');
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'From Address',
        ];
    }

    protected function getMailcoachSes(): MailcoachSes
    {
        $credentials = $this->state()->forStep('mailcoach-ui::ses-authentication-step');

        $sesConfig = new MailcoachSesConfig(
            $credentials['key'],
            $credentials['secret'],
            $credentials['region'],
        );

        return new MailcoachSes($sesConfig);
    }
}
