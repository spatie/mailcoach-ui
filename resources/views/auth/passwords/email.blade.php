<x-mailcoach-ui::layout-auth :title="__('Forgot password?')">
    <h1 class="markup-h2">{{ __('Forgot password?') }}</h1>

    <form class="form-grid" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-field">
            @error('email')
                <p class="form-error" role="alert">
                {{ $message }}
                </p>
            @enderror

            <label for="email" class="label">{{ __('Email') }}</label>

            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <x-mailcoach::form-buttons>
            <x-mailcoach::button :label="__('Send password reset link')" />
        </x-mailcoach::form-buttons>
    </form>
</x-mailcoach-ui::layout-auth>
