<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Ses\Steps;

use Exception;
use Illuminate\Validation\Rule;
use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachSesSetup\Exception\InvalidAwsCredentials;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Concerns\UsesMailer;

class AuthenticationStepComponent extends StepComponent
{
    use LivewireFlash;
    use UsesMailer;

    public string $key = '';
    public string $secret = '';
    public string $region = '';

    public function rules()
    {
        return [
            'key' => ['required'],
            'secret' => ['required'],
            'region' => ['required', Rule::in(array_keys($this->availableRegions()))],
        ];
    }

    public function mount()
    {
        $this->key = $this->mailer()->get('ses_key', '');
        $this->secret = $this->mailer()->get('ses_secret', '');
        $this->region = $this->mailer()->get('ses_region', '');
    }

    public function submit()
    {
        $this->validate();

        $config = new MailcoachSesConfig($this->key, $this->secret, $this->region);

        try {
            (new MailcoachSes($config))->ensureValidAwsCredentials();
        } catch (InvalidAwsCredentials) {
            $this->addError('key', 'These credentials are not valid.');
            $this->addError('secret', 'These credentials are not valid.');

            return;
        } catch (Exception $e) {
            $this->addError('key', 'Something went wrong communicating with AWS: ' . $e->getMessage());
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
        return [
            'us-east-2' => 'US East (Ohio) - us-east-2',
            'us-east-1' => 'US East (N. Virginia) - us-east-1',
            'us-west-1' => 'US West (N. California) - us-west-1',
            'us-west-2' => 'US West (Oregon) - us-west-2',
            'af-south-1' => 'Africa (Cape Town) - af-south-1',
            'ap-south-1' => 'Asia Pacific (Mumbai) - ap-south-1',
            'ap-northeast-3' => 'Asia Pacific (Osaka) - ap-northeast-3',
            'ap-northeast-2' => 'Asia Pacific (Seoul) - ap-northeast-2',
            'ap-southeast-1' => 'Asia Pacific (Singapore) - ap-southeast-1',
            'ap-southeast-2' => 'Asia Pacific (Sydney) - ap-southeast-2',
            'ap-northeast-1' => 'Asia Pacific (Tokyo) - ap-northeast-1',
            'ca-central-1' => 'Canada (Central) - ca-central-1',
            'cn-northwest-1' => 'China (Ningxia) - cn-northwest-1',
            'eu-central-1' => 'Europe (Frankfurt) - eu-central-1',
            'eu-west-1' => 'Europe (Ireland) - eu-west-1',
            'eu-west-2' => 'Europe (London) - eu-west-2',
            'eu-south-1' => 'Europe (Milan) - eu-south-1',
            'eu-west-3' => 'Europe (Paris) - eu-west-3',
            'eu-north-1' => 'Europe (Stockholm) - eu-north-1',
            'me-south-1' => 'Middle East (Bahrain) - me-south-1',
            'sa-east-1' => 'South America (São Paulo) - sa-east-1',
            'us-gov-west-1' => 'AWS GovCloud (US) - us-gov-west-1',
        ];
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.ses.authentication', [
            'regions' => $this->availableRegions(),
        ]);
    }
}
