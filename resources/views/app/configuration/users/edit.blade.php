<x-mailcoach-ui::layout-settings 
    :title="$user->name" 
    :originTitle="__('Users')"
    :originHref="route('users')"
>
    <form class="form-grid" action="{{ route('users.edit', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <x-mailcoach::text-field type="email" :label="__('Email')" name="email" :value="$user->email" required />

        <x-mailcoach::text-field :label="__('Name')" name="name" :value="$user->name" required />

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Save user')" />
        </div>
    </form>
</x-mailcoach-ui::layout-settings>