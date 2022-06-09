<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Exception;
use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSesSetup\Exception\InvalidAwsCredentials;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Concerns\UsesMailer;

class AuthenticationStepComponent extends StepComponent
{
    use LivewireFlash;
    use UsesMailer;

    public string $key = '';
    public string $secret = '';
    public string $region = '';

    public $rules = [
        'key' => ['required'],
        'secret' => ['required'],
    ];

    public function mount()
    {
        $this->key = $this->mailer()->get('ses_key', '');
        $this->secret = $this->mailer()->get('ses_secret', '');

        $firstRegion = collect($this->availableRegions())->first();
        $this->region = $this->mailer()->get('ses_region', $firstRegion);
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
        } catch (Exception) {
            $this->flash('Something went wrong communicating with AWS.');
        }

        $this->flash('Your credentials were correct.');

        $this->mailer()->merge([
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
            'af-south-1',
            'ap-east-1',
            'ap-northeast-1',
            'ap-northeast-2',
            'ap-northeast-3',
            'ap-south-1',
            'ap-southeast-1',
            'ap-southeast-2',
            'ap-southeast-3',
            'ap-southeast-3',
            'ca-central-1',
            'eu-central-1',
            'eu-north-1',
            'eu-south-1',
            'eu-west-1',
            'eu-west-2',
            'eu-west-3',
            'me-south-1',
            'sa-east-1',
            'us-east-1',
            'us-east-2',
            'us-west-1',
            'us-west-2',
        ];

        return array_combine($regions, $regions);
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.ses.authentication', [
            'regions' => $this->availableRegions(),
        ]);
    }
}
