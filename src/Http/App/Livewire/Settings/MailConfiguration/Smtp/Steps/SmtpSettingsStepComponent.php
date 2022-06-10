<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Smtp\Steps;

use Exception;
use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSesSetup\Exception\InvalidAwsCredentials;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Concerns\UsesMailer;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\Smtp\SmtpTransport;

class SmtpSettingsStepComponent extends StepComponent
{
    use LivewireFlash;
    use UsesMailer;

    public string $host = '';
    public ?int $port;
    public string $username = '';
    public string $password = '';
    public string $encryption = '';


    public $rules = [
        'host' => 'required',
        'port' => 'required',
        'username' => 'required',
        'password' => 'required',
        'encryption' => '',
    ];

    public function mount()
    {
        $this->host = $this->mailer()->get('host', '');
        $this->port = $this->mailer()->get('port', 25);
        $this->username = $this->mailer()->get('username', '');
        $this->password = $this->mailer()->get('password', '');
        $this->encryption = $this->mailer()->get('encryption', '');
    }

    public function submit()
    {
        $this->validate();

        $this->flash('Your credentials were correct.');

        $this->mailer()->merge([
            'driver' => 'smtp',
            'host' => $this->host,
            'port' => $this->port,
            'username' => $this->username,
            'password' => $this->password,
            'encryption' => $this->encryption,
        ]);

        $this->flash('Settings saved');

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'SMTP settings',
        ];
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.smtp.settings', [
            'encryptionOptions' => $this->encryptionOptions()
            ]);
    }

    public function encryptionOptions()
    {
        return [
            '' => 'None',
            'tls' => 'TLS',
        ];
    }
}
