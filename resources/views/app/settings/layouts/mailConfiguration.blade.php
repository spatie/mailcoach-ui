@extends('mailcoach-ui::app.settings.layouts.settings')

@section('main')
    <nav class="tabs">
        <ul>
            <x-mailcoach::navigation-item :href="route('mailConfiguration')">
                {{ __('Campaigns') }}
            </x-mailcoach::navigation-item>
            <x-mailcoach::navigation-item :href="route('transactionalMailConfiguration')">
                {{ __('Transactional Emails') }}
            </x-mailcoach::navigation-item>
        </ul>
    </nav>

    @yield('mailConfiguration')
@endsection
