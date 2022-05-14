<div>
    This is the first step

    <div>My value: {{ $this->myValue }}</div>


    <div class="underline mt-2" wire:click="nextStep">
        Go to the next step
    </div>

    <div class="underline mt-2" wire:click="activateStep('mailcoach-ui::step-3')">
        Last step
    </div>
</div>
