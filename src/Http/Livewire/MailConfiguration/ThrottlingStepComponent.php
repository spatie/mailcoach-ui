<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Concerns\UsesMailer;

class ThrottlingStepComponent extends StepComponent
{
    use LivewireFlash;
    use UsesMailer;

    public int $timespanInSeconds = 1;
    public int $mailsPerTimeSpan = 10;

    public array $rules = [
        'timespanInSeconds' => 'required|numeric|gte:1',
        'mailsPerTimeSpan' => 'required|numeric|gte:1',
    ];

    public function mount()
    {
        $this->timespanInSeconds = $this->mailer()->get('timespan_in_seconds', $this->timespanInSeconds);
        $this->mailsPerTimeSpan = $this->mailer()->get('mails_per_timespan', $this->mailsPerTimeSpan);
    }

    public function submit()
    {
        $this->validate();

        $this->mailer()->merge([
            'timespan_in_seconds' => $this->timespanInSeconds,
            'mails_per_timespan' => $this->mailsPerTimeSpan,

        ]);

        $this->flash('The throttling settings were saved.');

        $this->nextStep();
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.throttling');
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Throttling',
        ];
    }
}
