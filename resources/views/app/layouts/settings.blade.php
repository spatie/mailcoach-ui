<x-mailcoach::layout
    :originTitle="$originTitle ?? __('Settings')"
    :originHref="$originHref ?? null"
    :title="$title ?? null"
    breadcrumbsNavigationClass="{{ \Spatie\MailcoachUi\SettingsNavigation::class }}"
>
    <x-slot name="nav">
        <x-mailcoach::navigation>
            @foreach (app(\Spatie\MailcoachUi\SettingsNavigation::class)->tree() as $item)
                @if(count($item['children']))
                    <x-mailcoach::navigation-group :title="__($item['title'])">

                        @foreach($item['children'] as $child)
                            <x-mailcoach::navigation-item :href="$child['url']">
                                {{ __($child['title']) }}
                            </x-mailcoach::navigation-item>
                        @endforeach
                    </x-mailcoach::navigation-group>
                @else
                    <x-mailcoach::navigation-item :href="$item['url']">
                        {{ __($item['title']) }}
                    </x-mailcoach::navigation-item>
                @endif
            @endforeach
        </x-mailcoach::navigation>
    </x-slot>

    {{ $slot }}
</x-mailcoach::layout>
