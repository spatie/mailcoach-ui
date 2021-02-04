@extends('mailcoach-ui::app.layouts.settings')

@section('main')
    <x-mailcoach::navigation-tabs>
        <x-mailcoach::navigation-item :href="route('mailConfiguration')">
            {{ __('Campaigns') }}
        </x-mailcoach::navigation-item>
        <x-mailcoach::navigation-item :href="route('transactionalMailConfiguration')">
            {{ __('Transactional Mails') }}
        </x-mailcoach::navigation-item>
    </x-mailcoach::navigation-tabs>

    @yield('mailConfiguration')
@endsection
