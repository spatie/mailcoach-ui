<?php

namespace Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps;

use Spatie\LivewireWizard\Components\StepComponent;

class SummaryStepComponent extends StepComponent
{
    public function render()
    {
        return view('mailcoach-ui::app.drivers.campaigns.livewire.ses.summary');
    }

    public function stepInfo(): array
    {
        return [
            'label' => 'Summary',
        ];
    }
}
