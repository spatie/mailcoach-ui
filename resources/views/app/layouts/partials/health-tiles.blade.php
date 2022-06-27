@if ((! request()->routeIs('mailConfiguration')) || (! $usesVapor && ! $horizonActive && \Composer\InstalledVersions::isInstalled("laravel/horizon")) || ! $queueConfig)
    @if(\Spatie\MailcoachUi\MailcoachUiServiceProvider::getMailerClass()::count() === 0)
        <x-mailcoach::tile class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded" cols="2" icon="server">
            <x-slot:link><a class="underline" href="{{ route('mailers') }}" data-turbo="false">Mailers</a></x-slot:link>
            {!! __('You need to add <strong>at least 1 mailer.</strong>') !!}
        </x-mailcoach::tile>
    @endif

    @if (! $queueConfig)
        <x-mailcoach::tile class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded" cols="2" icon="database">
            <x-slot:link><a class="underline" href="https://spatie.be/docs/laravel-mailcoach" data-turbo="false">Docs</a></x-slot:link>
            {!! __('No valid <strong>queue connection</strong> found. Configure a queue connection with the <strong>mailcoach-redis</strong> key.') !!}
        </x-mailcoach::tile>
    @endif

    @if(! $usesVapor && ! $horizonActive && \Composer\InstalledVersions::isInstalled("laravel/horizon"))
        <x-mailcoach::tile class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded" cols="2" icon="database">
            <x-slot:link><a class="underline" href="https://spatie.be/docs/laravel-mailcoach" data-turbo="false">Docs</a></x-slot:link>
            {!! __('<strong>Horizon</strong> is not active on your server.') !!}
        </x-mailcoach::tile>
    @endif
@endif
