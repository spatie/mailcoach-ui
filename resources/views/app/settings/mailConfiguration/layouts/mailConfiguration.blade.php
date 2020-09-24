@extends('mailcoach::app.layouts.app', [
    'title' => isset($titlePrefix) ?  $titlePrefix . ' | ' . __('Mail configuration') : __('Mail configuration')
])

@section('header')
    <nav>
        <ul class="breadcrumbs">
            @yield('breadcrumbs')
        </ul>
    </nav>
@endsection

@section('content')
    <nav class="tabs">
        <ul>
            <x-mailcoach::navigation-item :href="route('mailConfiguration')">
                <x-mailcoach::icon-label icon="fa-server" :text="__('Mail configuration')" />
            </x-mailcoach::navigation-item>
            <x-mailcoach::navigation-item :href="route('sendTestMail')">
                <x-mailcoach::icon-label icon="fa-paper-plane" :text="__('Send test mail')" />
            </x-mailcoach::navigation-item>
        </ul>
    </nav>

    <section class="card card-grid">
        @yield('mailConfiguration')
    </section>
@endsection
