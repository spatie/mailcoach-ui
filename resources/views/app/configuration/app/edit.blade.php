<x-mailcoach-ui::layout-settings :title="__('App')">
    <form
        class="form-grid"
        action="{{ route('appConfiguration') }}"
        method="POST"
        data-cloak
    >
        @method('PUT')
        @csrf

        <x-mailcoach::text-field name="name" id="name" :label="__('App name')" :value="$appConfiguration->name ?? config('app.name')" />
        <x-mailcoach::text-field name="url" id="url" :label="__('App url')" :value="$appConfiguration->url ?? config('app.url')" />

        <x-mailcoach::select-field
            :label="__('Timezone')"
            name="timezone"
            :value="$appConfiguration->timezone"
            :options="$timeZones"
        />

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Save')"/>
        </div>
    </form>
</x-mailcoach-ui::layout-settings>
