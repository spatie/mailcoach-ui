<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Mailers;

use Spatie\MailcoachUi\Models\Mailer;

class DestroyMailerController
{
    public function __invoke(Mailer $mailer)
    {
        $mailer->delete();

        flash()->success(__('The mailer has been deleted.'));

        return redirect()->action(MailersIndexController::class);
    }
}
