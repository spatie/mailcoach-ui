<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachUi\Mail\TestMail;
use Symfony\Component\Mime\Email;

class SendTest extends Component
{
    use LivewireFlash;

    public string $mailer = '';

    public string $from_email = '';
    public string $to_email = '';

    public function mount(string $mailer)
    {
        $this->mailer = $mailer;
        $this->from_email = auth()->user()->email;
        $this->to_email = auth()->user()->email;
    }

    public function sendTest()
    {
        $this->validate([
            'from_email' => ['required', 'email:rfc,dns'],
            'to_email' => ['required', 'email:rfc,dns'],
        ]);

        try {
            $mail = new TestMail($this->from_email, $this->to_email);
            $mail->withSymfonyMessage(function (Email $message) {
                $message->getHeaders()->addTextHeader('X-MAILCOACH', 'true');
            });

            Mail::mailer($this->mailer)->send($mail);
        } catch (\Throwable $e) {
            $this->flashError($e->getMessage());
            $this->dispatchBrowserEvent('modal-closed', ['modal' => 'send-test']);
            return;
        }

        $this->flash(__('A test mail has been sent to :email. Please check if it arrived.', ['email' => $this->to_email]));

        $this->dispatchBrowserEvent('modal-closed', ['modal' => 'send-test']);
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.partials.sendTest');
    }
}
