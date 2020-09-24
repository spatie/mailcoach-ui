@extends('mailcoach::app.layouts.app', [
    'title' => isset($titlePrefix) ?  $titlePrefix . ' | ' . __('Transactional mail configuration') : __('Transactional mail configuration')
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
            <x-mailcoach::navigation-item :href="route('transactionalMailConfiguration')">
                <x-mailcoach::icon-label icon="fa-server" :text="__('Transactional mail configuration')" />
            </x-mailcoach::navigation-item>
            <x-mailcoach::navigation-item :href="route('sendTransactionalTestEmail')">
                <x-mailcoach::icon-label icon="fa-paper-plane" :text="__('Send transactional test mail')" />
            </x-mailcoach::navigation-item>
        </ul>
    </nav>

    <section class="card card-grid">
        @yield('mailConfiguration')
    </section>
@endsection
