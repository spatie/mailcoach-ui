<?php

namespace Spatie\MailcoachUi\Http\Livewire;

use Livewire\Component;
use Spatie\MailcoachUi\Models\Mailer;

class EditMailer extends Component
{
    public Mailer $mailer;

    public function mount(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function render()
    {
        return view("mailcoach-ui::app.configuration.mailers.wizards.{$this->mailer->transport->value}.index")
            ->layout('mailcoach-ui::app.layouts.settings', ['title' => $this->mailer->name]);
    }
}
