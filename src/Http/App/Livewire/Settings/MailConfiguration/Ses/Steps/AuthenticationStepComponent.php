<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSesSetup\Exception\InvalidAwsCredentials;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfiguration;

class AuthenticationStepComponent extends StepComponent
{
    use LivewireFlash;
    public string $key = '';
    public string $secret = '';
    public string $region = 'us-east-1';

    public $rules = [
        'key' => ['required'],
        'secret' => ['required'],
    ];

    public function mount()
    {
        $configuration = app(MailConfiguration::class);

        $this->key = $configuration->get('ses_key', '');
        $this->secret = $configuration->get('ses_secret', '');
        $this->region = $configuration->get('ses_region', '');
    }

    public function submit()
    {
        $this->validate();

        $config = new MailcoachSesConfig($this->key, $this->secret, $this->region);

        try {
            (new MailcoachSes($config))->ensureValidAwsCredentials();
        } catch (InvalidAwsCredentials) {
            $this->flash('These credentials are not valid.', 'error');

            return;
        }

        $this->flash('Your credentials were correct.');

        app(MailConfiguration::class)->merge([
            'driver' => 'ses',
            'ses_key' => $this->key,
            'ses_secret' => $this->secret,
            'ses_region' => $this->region,
        ]);

        $this->nextStep();
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Authenticate',
        ];
    }

    public function availableRegions(): array
    {
        $regions = [
            'us-east-1',
            'us-west-1',
            'us-west-2',
            'eu-west-1',
            'eu-central-1',
        ];

        return array_combine($regions, $regions);
    }

    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.ses.authentication', [
            'regions' => $this->availableRegions(),
        ]);
    }
}
