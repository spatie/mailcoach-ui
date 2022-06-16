<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\SendGrid\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Concerns\UsesMailer;

class SummaryStepComponent extends StepComponent
{
    use UsesMailer;

    public int $mailerId;

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.sendGrid.summary', [
            'mailer' => $this->mailer(),
        ]);
    }

    public function sendTestEmail()
    {
    }

    public function startOver()
    {
        $this->showStep('mailcoach-ui::ses-authentication-step');
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Summary',
        ];
    }
}
