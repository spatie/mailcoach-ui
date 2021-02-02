<div class="dropdown" data-dropdown>
    <button class="dropdown-trigger" data-dropdown-trigger-hover>
        <i class="fas fa-cog | block text-2xl icon-button"></i>
    </button>
    <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
        <x-mailcoach::navigation-item :href="route('account')">
            <x-mailcoach::icon-label icon="fas fa-fw fa-user" :text="__('Account')" />
        </x-mailcoach::navigation-item>
        <x-mailcoach::navigation-item :href="route('appConfiguration')">
            <x-mailcoach::icon-label icon="far fa-fw fa-cog" :text="__('Configuration')" />
        </x-mailcoach::navigation-item>
        <li class="mt-2 pt-2 border-t border-dashed border-gray-200">
            <form method="post" action="{{ route('logout') }}">
                {{ csrf_field() }}
                <button type="submit">
                    <x-mailcoach::icon-label icon="fas fa-fw fa-power-off text-red-500" :text="__('Log out')" />
                </button>
            </form>
        </li>
    </ul>
</div>
