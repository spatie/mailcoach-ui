<form class="form-grid" wire:submit.prevent="saveUser" method="POST">
    @csrf
    <x-mailcoach::text-field type="email" :label="__('Email')" wire:model.lazy="email" name="email" required />

    <x-mailcoach::text-field :label="__('Name')" name="name" wire:model.lazy="name" required />

    <x-mailcoach::form-buttons>
        <x-mailcoach::button :label="__('Create new user')" />

        <button type="button" class="button-cancel" x-on:click="$store.modals.close('create-user')">
            {{ __('Cancel') }}
        </button>
    </x-mailcoach::form-buttons>
</form>
