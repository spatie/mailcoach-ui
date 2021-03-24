<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\MailConfiguration;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\MailcoachUi\Mail\TestMail;
use Swift_Message;

class SendTestMailController
{
    public function show()
    {
        return view('mailcoach-ui::app.drivers.campaigns.edit');
    }

    public function sendTestEmail(Request $request)
    {
        $request->validate([
            'from_email' => 'email',
            'to_email' => 'email',
        ]);

        try {
            $mail = new TestMail($request->from_email, $request->to_email);
            $mail->withSwiftMessage(function (Swift_Message $message) {
                $message->getHeaders()->addTextHeader('X-MAILCOACH', 'true');
            });

            Mail::mailer('mailcoach')
                ->to($request->to_email)
                ->send($mail);

            flash()->success(__('A test mail has been sent to :email. Please check if it arrived.', ['email' => $request->to_email]));
        } catch (Exception $exception) {
            report($exception);

            flash()->error(__('Something went wrong with sending the mail: :errorMessage', ['errorMessage' => $exception->getMessage()]));
        }

        return redirect()->back();
    }
}
