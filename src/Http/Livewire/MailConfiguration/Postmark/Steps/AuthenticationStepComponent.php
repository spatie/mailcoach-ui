<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Postmark\Steps;

use Exception;
use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachPostmarkSetup\Postmark;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Concerns\UsesMailer;

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
        $this->apiKey = $this->mailer()->get('apiKey', '');
    }

    public function submit()
    {
        $this->validate();

        try {
            $validApiKey = (new Postmark($this->apiKey))->hasValidServerToken();
        } catch (Exception) {
            $this->flash('Something went wrong communicating with Postmark.', 'error');

            return;
        }

        if (! $validApiKey) {
            $this->addError('apiKey', 'This is not a valid Server API token.');

            return;
        }

        $this->flash('The Server API token is correct.');

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
        return view('mailcoach-ui::app.configuration.mailers.wizards.postmark.authentication');
    }
}
