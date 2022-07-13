<div wire:init="loadStreams">
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <x-mailcoach::card>
        <form class="form-grid" wire:submit.prevent="submit">
            <x-mailcoach::select-field
                wire:model.lazy="streamId"
                :label="__('Message Stream')"
                :options="$messageStreams"
                :disabled="!count($messageStreams)"
                :placeholder="__('Select a message stream')"
            />

            <x-mailcoach::form-buttons>
                <x-mailcoach::button :label="__('Save')" :disabled="!count($messageStreams)" />
        </x-mailcoach::form-buttons>
        </form>
    </x-mailcoach::card>
</div>
