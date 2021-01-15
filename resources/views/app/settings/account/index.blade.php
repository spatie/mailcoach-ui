@extends('mailcoach-ui::app.settings.account.layouts.account')

@section('breadcrumbs')
    <li>{{ __('Account') }}</li>
@endsection

@section('account')
    <h1 class="text-xl font-bold mb-8">User details</h1>
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
            <button type="submit" class="button">
                <x-mailcoach::icon-label icon="fas fa-user" :text="__('Save user')" />
            </button>
        </div>
    </form>
@endsection
