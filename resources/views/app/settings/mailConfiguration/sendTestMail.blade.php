@extends('mailcoach-ui::app.settings.mailConfiguration.layouts.mailConfiguration', ['title' => __('Send Test')])

@section('breadcrumbs')
    <li>
        <a href="{{ route('mailConfiguration') }}">
            {{ __('Mail configuration') }}
        </a>
    </li>
    <li>{{ __('Send test mail') }}</li>
@endsection

@section('mailConfiguration')
    <form class="form-grid" method="POST">
        @csrf
        <x-mailcoach::text-field :placeholder="__('From Email')" :label="__('From Email')" name="from_email" type="email" :value="auth()->user()->email"/>

        <x-mailcoach::text-field :placeholder="__('To Email')" :label="__('To Email')" name="to_email" type="email"/>

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Send Test Mail')" />
        </div>
    </form>
@endsection
