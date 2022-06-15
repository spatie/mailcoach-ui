<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Mailers;

use Spatie\MailcoachUi\Models\Mailer;

class EditMailerController
{
    public function __invoke(Mailer $mailer)
    {
        return view("mailcoach-ui::app.configuration.mailers.wizards.{$mailer->transport->value}.index", [
            'mailer' => $mailer,
        ]);
    }
}
