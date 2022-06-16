<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Concerns;

use Spatie\MailcoachUi\Models\Mailer;

trait UsesMailer
{
    private ?Mailer $mailer = null;

    public function mailer(): Mailer
    {
        if ($this->mailer) {
            return $this->mailer;
        }

        $summaryStepName = $this->summaryStepName();

        $mailerId = $this->state()->forStep($summaryStepName)['mailerId'];

        $this->mailer = Mailer::find($mailerId);

        return $this->mailer;
    }

    public function summaryStepName(): string
    {
        return collect($this->allStepNames)->last();
    }
}
