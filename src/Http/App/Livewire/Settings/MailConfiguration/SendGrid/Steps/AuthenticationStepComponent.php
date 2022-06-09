<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid\Steps;

use Exception;
use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSendgridSetup\Sendgrid;
use Spatie\MailcoachSesSetup\Exception\InvalidAwsCredentials;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Concerns\UsesMailer;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfiguration;

class AuthenticationStepComponent extends StepComponent
{
    use LivewireFlash;
    use UsesMailer;

    public string $apiKey = '';

    public $rules = [
        'apiKey' => ['required'],
    ];

    public function mount()
    {
        $this->key = $this->mailer()->get('apiKey', '');
    }

    public function submit()
    {
        $this->validate();

        (new Sendgrid('invalid-key'))->isValidApiKey();

        try {
            $validApiKey = (new Sendgrid($this->apiKey))->isValidApiKey();
        } catch (Exception) {
            $this->flash('Something went wrong communicating with SendGrid.', 'error');


            return;
        }

        if (! $validApiKey) {
            $this->flash('This is not a valid API key.', 'error');

            return;
        }

        $this->flash('The API key is correct.');

        $this->mailer()->merge([
            'apiKey' => $this->apiKey,
        ]);

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Authenticate',
        ];
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.sendGrid.authentication');
    }
}
