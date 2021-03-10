<x-mailcoach-ui::layout-settings :title="__('Profile')">
    <form
        class="form-grid"
        action="{{ route('account') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-mailcoach::text-field :label="__('Email')" name="email" type="email" :value="$user->email" required />
        <x-mailcoach::text-field :label="__('Name')" name="name" :value="$user->name" required />

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Save user')" />
        </div>
    </form>
</x-mailcoach-ui::layout-settings>
