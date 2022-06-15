<form
    class="form-grid"
    wire:submit.prevent="save"
    method="POST"
    data-cloak
>
    @method('PUT')
    @csrf

    <x-mailcoach::text-field name="name" id="name" wire:model="name" :label="__('App name')" />
    <x-mailcoach::text-field name="url" id="url" wire:model="url" :label="__('App url')" />

    <x-mailcoach::select-field
        :label="__('Timezone')"
        name="timezone"
        wire:model="timezone"
        :options="$timeZones"
    />

    <x-mailcoach::text-field name="from_address" id="from_address" wire:model="from_address" :label="__('Default email from address')" />

    <div class="form-buttons">
        <x-mailcoach::button :label="__('Save')"/>
    </div>
</form>
