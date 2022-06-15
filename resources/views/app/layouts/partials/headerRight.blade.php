<div
    class="navigation-item group relative mr-2 cursor-pointer ml-auto"
    x-on:mouseenter="open"
    x-on:mouseleave="close"
    x-on:touchstart="open"
    x-on:click.outside="close"
    x-on:keyup.escape.window="close"
>
    <a class="block h-full py-4 px-4" href="{{ route('account') }}">
        <img class="rounded-full w-10 h-10 border-blue-100 border-2" src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}" alt="{{ auth()->user()->name }}">
    </a>
    <div class="navigation-dropdown md:hidden md:opacity-0 md:absolute md:left-1/2 md:-translate-x-1/2 overflow-hidden py-3 rounded transition-opacity duration-200 z-50 min-w-32 will-change-auto">
        <a class="navigation-link block w-full py-2 md:hover:bg-blue-100 px-4 text-blue-100 md:text-black" href="{{ route('account') }}">{{ __('Profile') }}</a>
        <a class="navigation-link block w-full py-2 md:hover:bg-blue-100 px-4 text-blue-100 md:text-black" href="{{ route('general-settings') }}">{{ __('Configuration') }}</a>
        <form class="navigation-link block w-full py-2 md:hover:bg-blue-100 px-4 text-blue-100 md:text-black" method="post" action="{{ route('logout') }}">
            {{ csrf_field() }}
            <button type="submit" class="font-semibold">
                <x-mailcoach::icon-label icon="fas fa-fw fa-power-off text-red-500" :text="__('Log out')" />
            </button>
        </form>
    </div>
</div>
