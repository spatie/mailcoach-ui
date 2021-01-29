@extends('mailcoach::app.layouts.app')

@section('header')
    <nav>
        <ul class="breadcrumbs">
            @yield('breadcrumbs')
        </ul>
    </nav>
@endsection

@section('content')
    <x-mailcoach::card>
        <x-slot name="nav">
            <x-mailcoach::card-nav :title="__('Account')">
                <x-mailcoach::navigation-item :href="route('account')">
                    {{ __('User details') }}
                </x-mailcoach::navigation-item>
                <x-mailcoach::navigation-item :href="route('password')">
                    {{ __('Password') }}
                </x-mailcoach::navigation-item>
                <x-mailcoach::navigation-item :href="route('tokens')">
                    {{ __('API Tokens') }}
                </x-mailcoach::navigation-item>
            </x-mailcoach::card-nav>
        </x-slot>
    
        @yield('account')
       
    </x-mailcoach::card>
@endsection
