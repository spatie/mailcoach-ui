<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSesSetup\Exception\InvalidAwsCredentials;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;

class AuthenticationStepComponent extends StepComponent
{
    use LivewireFlash;
    public string $key = 'my key';
    public string $secret = '';
    public string $region = '';

    public $rules = [
        'key' => ['required'],
        'secret' => ['required'],
    ];

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

        $this->nextStep();
    }

    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.ses.authentication', [
            'regions' => $this->availableRegions(),
        ]);
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Authenticate',
        ];
    }

    protected function availableRegions(): array
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
}
