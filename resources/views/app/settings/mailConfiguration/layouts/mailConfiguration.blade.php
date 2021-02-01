@extends('mailcoach-ui::app.settings.layouts.configuration')

@section('configuration')
    <nav class="tabs">
        <ul>
            <x-mailcoach::navigation-item :href="route('mailConfiguration')">
                {{ __('Campaigns') }}
            </x-mailcoach::navigation-item>
            <x-mailcoach::navigation-item :href="route('transactionalMailConfiguration')">
                {{ __('Transactional Mails') }}
            </x-mailcoach::navigation-item>
        </ul>
    </nav>

    @yield('mailConfiguration')
@endsection
