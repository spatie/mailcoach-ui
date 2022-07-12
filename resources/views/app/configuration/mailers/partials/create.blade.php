<form class="form-grid" wire:submit.prevent="saveMailer" method="POST">
    @csrf

    <x-mailcoach::text-field type="name" :label="__('Name')" wire:model.lazy="name" name="name" required />

    <x-mailcoach::select-field
        wire:model="transport"
        name="transport"
        :label="__('Transport')"
        :options="$transports"
    />

    <x-mailcoach::form-buttons>
        <x-mailcoach::button :label="__('Create new mailer')" />

        <button type="button" class="button-cancel" x-on:click="$store.modals.close('create-mailer')">
            {{ __('Cancel') }}
        </button>
    </x-mailcoach::form-buttons>
</form>
