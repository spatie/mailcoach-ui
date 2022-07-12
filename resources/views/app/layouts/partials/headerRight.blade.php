<div
    class="navigation-dropdown-trigger group"
    x-on:mouseenter="open"
    x-on:mouseleave="close"
    x-on:touchstart="open"
    x-on:click.outside="close"
    x-on:keyup.escape.window="close"
>
    <a class="group inline-flex items-center h-12" href="{{ route('account') }}">
        <div class="relative rounded-full w-8 h-8 shadow-md">
            <img class="rounded-full w-8 h-8 opacity-90 group-hover:opacity-100" src="https://www.gravatar.com/avatar/{{ md5(auth()->user()->email) }}" alt="{{ auth()->user()->name }}">
            <div class="absolute inset-0 rounded-full bg-gradient-to-t from-transparent to-white/30"></div>
            <div class="absolute inset-0 rounded-full border-2 border-t-white/30 border-l-white/30 border-r-black/10 border-b-black/10"></div>
        </div>
    </a>
    <div class="navigation-dropdown md:hidden md:opacity-0">
        <a x-on:click="select" class="navigation-link" href="{{ route('account') }}">{{ __('Profile') }}</a>
        <a x-on:click="select" class="navigation-link" href="{{ route('general-settings') }}">{{ __('Configuration') }}</a>
        <form class="navigation-link" method="post" action="{{ route('logout') }}">
            {{ csrf_field() }}
            <button type="submit" class="font-semibold">
                <x-mailcoach::icon-label invers caution icon="fas fa-fw fa-power-off" :text="__('Log out')" />
            </button>
        </form>
    </div>
</div>
