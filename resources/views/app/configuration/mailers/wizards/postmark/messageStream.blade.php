<div wire:init="loadStreams">
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <x-mailcoach::card>
        <form class="form-grid" wire:submit.prevent="submit">
            @if ($streamsLoaded)
                <x-mailcoach::select-field
                    wire:model="streamId"
                    :label="__('Message Stream')"
                    :options="$messageStreams"
                    :disabled="!count($messageStreams)"
                    :placeholder="__('Select a message stream')"
                />
            @else
                {{ __('Loading message streams...') }}
            @endif

            <x-mailcoach::form-buttons>
                <x-mailcoach::button :label="__('Save')" :disabled="!count($messageStreams)" />
        </x-mailcoach::form-buttons>
        </form>
    </x-mailcoach::card>
</div>
