@extends('mailcoach-ui::app.layouts.settings', ['title' => __('User Details')])

@section('main')
    <h1 class="markup-h1">{{ __('User Details') }}</h1>
    
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
@endsection
