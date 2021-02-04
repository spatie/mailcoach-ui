@extends('mailcoach::app.layouts.main', ['title' => $title  . ' | Settings' , 'logoIcon' => 'far fa-cog'])

@section('up')
    <x-mailcoach::navigation-back :href="route('mailcoach.home')" :label="__('Back to App')"/>
@endsection

@section('nav')
    <x-mailcoach::navigation deep>
        <x-mailcoach::navigation-group icon="fas fa-user" :title="__('Account')">
            <x-mailcoach::navigation-item :href="route('account')">
                {{ __('User details') }}
            </x-mailcoach::navigation-item>
            <x-mailcoach::navigation-item :href="route('password')">
                {{ __('Password') }}
            </x-mailcoach::navigation-item>
            <x-mailcoach::navigation-item :href="route('tokens')">
                {{ __('API Tokens') }}
            </x-mailcoach::navigation-item>
            <li class="flex justify-end">
                <form method="post" action="{{ route('logout') }}">
                    {{ csrf_field() }}
                    <button type="submit" class="font-semibold">
                        <x-mailcoach::icon-label icon="fas fa-fw fa-power-off text-red-500" :text="__('Log out')" />
                    </button>
                </form>
            </li>
        </x-mailcoach::navigation-group>

        <x-mailcoach::navigation-group icon="far fa-cogs" :title="__('Configuration')">
            <x-mailcoach::navigation-item :href="route('appConfiguration')">
                {{__('App') }}
            </x-mailcoach::navigation-item>

            <x-mailcoach::navigation-item :href="route('editor')">
                {{ __('Editor') }}
            </x-mailcoach::navigation-item>

            <x-mailcoach::navigation-item :href="route('users')">
                {{ __('Users') }}
            </x-mailcoach::navigation-item>

        </x-mailcoach::navigation-group>

        <x-mailcoach::navigation-group icon="far fa-server" :title="__('Drivers')">
            <x-mailcoach::navigation-item :href="route('mailConfiguration')">
                {{ __('Campaigns') }}
            </x-mailcoach::navigation-item>
           
            <x-mailcoach::navigation-item :href="route('transactionalMailConfiguration')">
                {{ __('Transactional Mail') }}
            </x-mailcoach::navigation-item>

        </x-mailcoach::navigation-group>
    </x-mailcoach::navigation>    
@endsection
