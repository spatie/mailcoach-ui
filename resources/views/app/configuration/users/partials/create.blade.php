<form class="form-grid" action="{{ route('users.create') }}" method="POST">
    @csrf
    <x-mailcoach::text-field type="email" :label="__('Email')" name="email" required />

    <x-mailcoach::text-field :label="__('Name')" name="name" required />

    <div class="form-buttons">
        <x-mailcoach::button :label="__('Create new user')" />

        <button type="button" class="button-cancel" data-modal-dismiss>
            {{ __('Cancel') }}
        </button>
    </div>
</form>
