<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Smtp\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Concerns\UsesMailer;

class SummaryStepComponent extends StepComponent
{
    use UsesMailer;

    public int $mailerId;

    public function mount()
    {
        if ($this->mailer()->isReadyForUse()) {
            return;
        }

        $this->mailer()->markAsReadyForUse();
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.smtp.summary', [
            'mailer' => $this->mailer(),
        ]);
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Summary',
        ];
    }
}
