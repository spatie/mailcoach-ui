@if (! request()->routeIs('mailcoach.dashboard'))
    @if ((! request()->routeIs('mailConfiguration') && \Spatie\MailcoachUi\MailcoachUiServiceProvider::getMailerClass()::count() === 0) || (! $usesVapor && ! $horizonActive && \Composer\InstalledVersions::isInstalled("laravel/horizon")) || ! $queueConfig)
        <div class="alert alert-error shadow-lg">
            <div class="max-w-layout mx-auto grid gap-1">
                @if (! request()->routeIs('mailConfiguration'))
                    @if(\Spatie\MailcoachUi\MailcoachUiServiceProvider::getMailerClass()::count() === 0)
                        <div class="flex items-baseline">
                            <span class="w-6"><i class="fas fa-server opacity-50"></i></span>
                            <span class="ml-2 text-sm">
                                {!! __('You need to add <strong>at least 1 mailer. Head over to the <a href=":mailConfigurationLink">mail configuration</a> screen.</strong>', ['mailConfigurationLink' => route('mailers')]) !!}
                            </span>
                        </div>
                    @endif
                @endif

                @if (! $queueConfig)
                    <div class="flex items-baseline">
                        <span class="w-6"><i class="fas fa-database opacity-50"></i></span>
                        <span class="ml-2 text-sm">
                            {!! __('No valid <strong>queue connection</strong> found. Configure a queue connection with the <strong>mailcoach-redis</strong> key. <a target="_blank" href=":docsLink">Read the docs</a>.', ['docsLink' => 'https://spatie.be/docs/laravel-mailcoach']) !!}
                        </span>
                    </div>
                @endif

                @if(! $usesVapor && ! $horizonActive && \Composer\InstalledVersions::isInstalled("laravel/horizon"))
                    <div class="flex items-baseline">
                        <span class="w-6"><i class="fas fa-database opacity-50"></i></span>
                        <span class="ml-2 text-sm">
                            {!! __('<strong>Horizon</strong> is not active on your server. <a target="_blank" href=":docsLink">Read the docs</a>.', ['docsLink' => 'https://spatie.be/docs/laravel-mailcoach']) !!}
                        </span>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endif
