<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\MailcoachUi\Models\Mailer;

trait UsesMailer
{
    public function mailer(): Mailer
    {
        $summaryStepName = $this->summaryStepName();

        $mailerId = $this->state()->forStep($summaryStepName)['mailerId'];

        return Mailer::find($mailerId);
    }

    public function summaryStepName(): string
    {
        return collect($this->allStepNames)->last();
    }
}
