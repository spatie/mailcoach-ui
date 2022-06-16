<?php

namespace Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Postmark\Steps;

use Exception;
use Spatie\LivewireWizard\Components\StepComponent;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachPostmarkSetup\MessageStream;
use Spatie\MailcoachPostmarkSetup\Postmark;
use Spatie\MailcoachUi\Http\Livewire\MailConfiguration\Concerns\UsesMailer;

class MessageStreamStepComponent extends StepComponent
{
    use LivewireFlash;
    use UsesMailer;

    public string $streamId = '';

    public array $messageStreams = [];

    public $rules = [
        'streamId' => ['required'],
    ];

    public function submit()
    {
        $this->validate();

        $this->mailer()->merge([
            'streamId' => $this->streamId,
        ]);

        $this->nextStep();
    }

    public function loadStreams()
    {
        $postmark = (new Postmark($this->mailer()->get('apiKey')));
        $this->messageStreams = $postmark->getStreams()->mapWithKeys(fn (MessageStream $stream) => [$stream->id => $stream->name])->toArray();
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Message Stream',
        ];
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.mailers.wizards.postmark.messageStream');
    }
}
