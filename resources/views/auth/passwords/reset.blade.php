<x-mailcoach-ui::layout-auth :title="__('Reset Password')">
    <h1 class="markup-h1">{{ __('Reset Password') }}</h1>

    <form class="form-grid" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-field">
            <label for="email" class="label">{{ __('Email') }}</label>

            <div>
                {{ $email ?? old('email') }}
            </div>
        </div>

        <input id="email" type="hidden" class="input @error('email') is-invalid @enderror" name="email"
                value="{{ $email ?? old('email') }}" required autocomplete="email">

        <div class="form-field">
            @error('password')
                <p class="form-error" role="alert">
                    {{ $message }}
                </p>
            @enderror

            <label for="password" class="label">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="input @error('password') is-invalid @enderror"
                        name="password" autofocus required autocomplete="new-password">

            </div>
        </div>

        <div class="form-field">
            <label for="password-confirm"
                    class="label">{{ __('Confirm password') }}</label>

            <input id="password-confirm" type="password" class="input" name="password_confirmation"
                        required
                        autocomplete="new-password">
        </div>

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Reset Password')" />
        </div>

    </form>
</x-mailcoach-ui::layout-auth>
