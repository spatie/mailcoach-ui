<form
    class="form-grid"
    wire:submit.prevent="save"
    method="POST"
>
    @csrf
    @method('PUT')

    <x-mailcoach::text-field :label="__('Email')" name="email" type="email" wire:model.lazy="email" required />
    <x-mailcoach::text-field :label="__('Name')" name="name" wire:model.lazy="name" required />

    <div class="form-buttons">
        <x-mailcoach::button :label="__('Save user')" />
    </div>
</form>
