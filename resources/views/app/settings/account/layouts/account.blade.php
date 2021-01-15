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
    <div class="card card-split">
        <nav class="card-nav">
            <h4 class="text-blue-200 text-opacity-50 flex justify-end font-bold text-xs uppercase tracking-widest mb-6">
                {{ __('Account') }}
            </h4>
            <ul>
                <x-mailcoach::navigation-item :href="route('account')">
                    {{ __('User details') }}
                </x-mailcoach::navigation-item>
                <x-mailcoach::navigation-item :href="route('password')">
                    {{ __('Password') }}
                </x-mailcoach::navigation-item>
                <x-mailcoach::navigation-item :href="route('tokens')">
                    {{ __('API Tokens') }}
                </x-mailcoach::navigation-item>
            </ul>
        </nav>

        <section class="card-main">
            @yield('account')
        </section>
    </div>
@endsection
