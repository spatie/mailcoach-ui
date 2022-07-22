<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Concerns\UsesMailer;
use Spatie\MailcoachSesSetup\MailcoachSes;
use Spatie\MailcoachSesSetup\MailcoachSesConfig;

class SummaryStepComponent extends StepComponent
{
    use UsesMailer;

    public int $mailerId;

    public function render()
    {
        $mailer = $this->mailer();

        $config = new MailcoachSesConfig(
            $mailer->get('ses_key'),
            $mailer->get('ses_secret'),
            $mailer->get('ses_region'),
        );

        $mailcoachSes = (new MailcoachSes($config));

        $isInSandboxMode = $mailcoachSes->isInSandboxMode();

        return view('mailcoach-ui::app.configuration.mailers.wizards.ses.summary', [
            'isInSandboxMode' => $isInSandboxMode,
            'mailer' => $mailer,
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
