<div wire:init="loadStreams">
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <div class="form-grid mt-4">
        <form class="form-grid" wire:submit.prevent="submit">
            <x-mailcoach::select-field
                wire:model.lazy="streamId"
                :label="__('Message Stream')"
                :options="$messageStreams"
                :disabled="!count($messageStreams)"
                :placeholder="__('Select a message stream')"
            />

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Save')" :disabled="!count($messageStreams)" />
            </div>
        </form>
    </div>
</div>
