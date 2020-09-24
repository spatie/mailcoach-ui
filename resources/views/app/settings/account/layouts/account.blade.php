@extends('mailcoach::app.layouts.app', [
    'title' => isset($titlePrefix) ?  $titlePrefix . ' | ' . __('Account') : __('Account')
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
            <x-mailcoach::navigation-item :href="route('account')">
                <x-mailcoach::icon-label icon="fa-user" :text="__('User details')" />
            </x-mailcoach::navigation-item>
            <x-mailcoach::navigation-item :href="route('password')">
                <x-mailcoach::icon-label icon="fa-lock" :text="__('Password')" />
            </x-mailcoach::navigation-item>
            <x-mailcoach::navigation-item :href="route('tokens')">
                <x-mailcoach::icon-label icon="fa-key" :text="__('API Tokens')" />
            </x-mailcoach::navigation-item>
        </ul>
    </nav>

    <section class="card">
        @yield('account')
    </section>
@endsection
