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

    <div class="form-buttons">
        <x-mailcoach::button :label="__('Save')"/>
    </div>
</form>
