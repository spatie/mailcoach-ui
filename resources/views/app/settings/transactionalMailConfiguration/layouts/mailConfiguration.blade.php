@extends('mailcoach-ui::app.settings.layouts.configuration')

@section('configuration')
    <nav class="tabs">
        <ul>
            <x-mailcoach::navigation-item :href="route('transactionalMailConfiguration')">
                {{ __('Transactional Mail Configuration') }}
            </x-mailcoach::navigation-item>
            <x-mailcoach::navigation-item :href="route('sendTransactionalTestEmail')">
                {{ __('Send Test') }}
            </x-mailcoach::navigation-item>
        </ul>
    </nav>

    @yield('mailConfiguration')
@endsection
