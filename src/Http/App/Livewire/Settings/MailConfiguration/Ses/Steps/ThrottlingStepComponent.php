<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfiguration;

class ThrottlingStepComponent extends StepComponent
{
    use LivewireFlash;

    public int $mailsPerTimespan = 5;
    public int $timespanInSeconds = 1;

    public array $rules = [
        'mailsPerTimespan' => ['required', 'integer'],
        'timespanInSeconds' => ['required', 'integer'],
    ];

    public function mount()
    {
        $configuration = app(MailConfiguration::class);

        $this->mailsPerTimespan = (int)$configuration->get('ses_mails_per_second', 5);
        $this->timespanInSeconds = (int)$configuration->get('timespan_in_seconds', 1);
    }

    public function submit()
    {
        $this->validate();

        app(MailConfiguration::class)->merge([
            'ses_mails_per_second' => $this->mailsPerTimespan,
            'timespan_in_seconds' => $this->timespanInSeconds,
        ]);

        $this->flash('The throttling options have been saved.');

        $this->nextStep();
    }

    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.ses.throttling');
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Throttling',
        ];
    }
}
