<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Smtp\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Concerns\UsesMailer;

class SummaryStepComponent extends StepComponent
{
    use UsesMailer;

    public int $mailerId;

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.smtp.summary', [
            'mailer' => $this->mailer(),
        ]);
    }

    public function sendTestEmail()
    {
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Summary',
        ];
    }
}
