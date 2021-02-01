@extends('mailcoach-ui::auth.layouts.master', ['title' => __('Forgot password?')])

@section('content')
    <form class="form-grid" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-row">
            @error('email')
                <p class="form-error" role="alert">
                {{ $message }}
                </p>
            @enderror

            <label for="email" class="label">{{ __('Email') }}</label>

            <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>

        <div class="form-buttons">
            <button type="submit" class="button">
                <span class="icon-label">
                    <i class="fas fa-envelope"></i>
                    <span class="icon-label-text">{{ __('Send password reset link') }}</span>
                </span>
            </button>
        </div>
    </form>
@endsection
