<form
    class="card-grid"
    wire:submit.prevent="save"
    @keydown.prevent.window.cmd.s="$wire.call('save')"
    @keydown.prevent.window.ctrl.s="$wire.call('save')"
    method="POST"
>
    @csrf
    @method('PUT')

    <x-mailcoach::card>
        <x-mailcoach::text-field :label="__('Current password')" name="current_password" type="password" wire:model.lazy="current_password"  required />
        <x-mailcoach::fieldset>
            <x-mailcoach::text-field :label="__('New password')" name="password" type="password" wire:model.lazy="password" required />
            <x-mailcoach::text-field :label="__('Confirm new password')" name="password_confirmation" wire:model.lazy="password_confirmation" type="password" required />
        </x-mailcoach::fieldset>
   
        <x-mailcoach::form-buttons>
            <x-mailcoach::button :label="__('Update password')" />
        </x-mailcoach::form-buttons>
    </x-mailcoach::card>

</form>
