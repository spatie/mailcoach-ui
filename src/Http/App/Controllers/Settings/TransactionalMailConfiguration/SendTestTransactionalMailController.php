<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\TransactionalMailConfiguration;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\MailcoachUi\Mail\TransactionalTestMail;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\TransactionalMailConfiguration;

class SendTestTransactionalMailController
{
    public function show(TransactionalMailConfiguration $mailConfiguration)
    {
        return view(
            'mailcoach-ui::app.drivers.transactionalMails.edit',
            compact('mailConfiguration')
        );
    }

    public function sendTransactionalTestEmail(Request $request)
    {
        $request->validate([
            'from_email' => 'email',
            'to_email' => 'email',
        ]);

        try {
            Mail::mailer('mailcoach-transactional')->to($request->to_email)->send((new TransactionalTestMail($request->from_email, $request->to_email)));

            flash()->success(__('A test mail has been sent to :email. Please check if it arrived.', ['email' => $request->to_email]));
        } catch (Exception $exception) {
            report($exception);

            flash()->error(__('Something went wrong with sending the mail: :errorMessage', ['errorMessage' => $exception->getMessage()]));
        }

        return redirect()->back();
    }
}
