<?php

namespace Spatie\MailcoachUi\Http\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\MailcoachUi\Enums\MailerTransport;
use Spatie\MailcoachUi\Models\UsesMailcoachUiModels;

class CreateMailer extends Component
{
    use UsesMailcoachUiModels;

    public string $name = '';
    public string $transport = '';

    public function mount()
    {
        $this->transport = array_key_first($this->getTransportOptions());
    }

    public function saveMailer()
    {
        $this->validate([
            'name' => ['required', 'string'],
            'transport' => 'required',
        ]);

        $mailer = self::getMailerClass()::create([
            'name' => $this->name,
            'transport' => $this->transport,
        ]);

        flash()->success(__('The mailer has been created.'));

        return redirect()->route('mailers.edit', $mailer);
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
