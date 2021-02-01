<div class="dropdown" data-dropdown>
    <button class="dropdown-trigger" data-dropdown-trigger>
        <i class="fas fa-cog | block text-2xl icon-button"></i>
    </button>
    <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
        <li>
            <x-mailcoach::navigation-item :href="route('account')">
                <x-mailcoach::icon-label icon="fas fa-fw fa-user" :text="__('Account')" />
            </x-mailcoach::navigation-item>
        </li>
        <li>
            <form method="post" action="{{ route('logout') }}">
                {{ csrf_field() }}
                <button type="submit">
                    <x-mailcoach::icon-label icon="fas fa-fw fa-power-off text-red-500" :text="__('Log out')" />
                </button>
            </form>
        </li>
        <li class="my-2 py-2 border-t border-gray-200">
            <p class="px-4 py-2 uppercase text-xs text-gray-400 tracking-widest"> {{ __('Configuration') }}</p>
            <ul>
                <x-mailcoach::navigation-item :href="route('appConfiguration')">
                    <x-mailcoach::icon-label icon="far fa-fw fa-cog" :text="__('App')" />
                </x-mailcoach::navigation-item>
            
                <x-mailcoach::navigation-item :href="route('users')">
                    <x-mailcoach::icon-label icon="far fa-fw fa-users" :text="__('Users')" />
                </x-mailcoach::navigation-item>
            
                <x-mailcoach::navigation-item :href="route('mailConfiguration')">
                    <x-mailcoach::icon-label icon="far fa-fw fa-server" :text="__('Mail Drivers')" />
                </x-mailcoach::navigation-item>
            
                <x-mailcoach::navigation-item :href="route('editor')">
                    <x-mailcoach::icon-label icon="far fa-fw fa-code" :text="__('Editor')" />
                </x-mailcoach::navigation-item>

            </ul>
        </li>
    </ul>
</div>
