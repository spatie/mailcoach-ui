<div>

    <ul>
        @foreach($steps as $step)
            <li class="{{ $step->isPrevious() ? 'underline' : '' }} {{ $step->isCurrent() ? 'text-red-500' : '' }}"
                @if ($step->isPrevious())
                    wire:click="{{ $step->activate() }}"
                @endif
            >

                {{ $step->label }}</li>
        @endforeach
    </ul>


    This is the first step

    <div>My value: {{ $this->myValue }}</div>


    <div class="underline mt-2" wire:click="nextStep">
        Go to the next step
    </div>

    <div class="underline mt-2" wire:click="activateStep('mailcoach-ui::step-3')">
        Last step
    </div>
</div>
