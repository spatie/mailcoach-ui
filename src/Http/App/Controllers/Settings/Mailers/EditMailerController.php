<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Mailers;

use Spatie\Mailcoach\MainNavigation;
use Spatie\MailcoachUi\Models\Mailer;

class EditMailerController
{
    public function __invoke(Mailer $mailer)
    {
        app(MainNavigation::class)->add('Edit Mailer');

        return view("mailcoach-ui::app.drivers.campaigns.{$mailer->transport->value}", [
            'mailer' => $mailer,
        ]);
    }
}
