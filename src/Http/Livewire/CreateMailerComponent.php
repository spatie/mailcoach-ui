<?php

namespace Spatie\MailcoachUi\Http\Livewire;

use Livewire\Component;
use Spatie\MailcoachUi\Enums\MailerTransport;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Mailers\EditMailerController;
use Spatie\MailcoachUi\Models\Mailer;

class CreateMailerComponent extends Component
{
    public string $name = '';
    public string $transport = '';

    public function mount()
    {
        $this->transport = array_key_first($this->getTransportOptions());
    }

    public function saveMailer()
    {
        $validated = $this->validate([
            'name' => 'required|string',
            'transport' => 'required',
        ]);

        $mailer = Mailer::create([
            'name' => $this->name,
            'transport' => $this->transport,
        ]);

        flash()->success(__('The mailer has been created.'));

        return redirect()->action(EditMailerController::class, $mailer);
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.partials.create', [
            'transports' => $this->getTransportOptions(),
        ]);
    }

    public function getTransportOptions(): array
    {
        return collect(MailerTransport::cases())
            ->mapWithKeys(fn (MailerTransport $transport) => [$transport->value => $transport->label()])
            ->toArray();
    }
}
