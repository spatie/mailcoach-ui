<x-mailcoach-ui::layout-settings :title="__('Password')">
    <form
        class="form-grid"
        action="{{ route('password') }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-mailcoach::text-field :label="__('Current password')" name="current_password" type="password"  required />
        <x-mailcoach::text-field :label="__('New password')" name="password" type="password"  required />
        <x-mailcoach::text-field :label="__('Confirm new password')" name="password_confirmation" type="password" required />

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Update password')" />
        </div>
    </form>
</x-mailcoach-ui::layout-settings>
