<div>
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <div class="alert alert-success">
        <p>
            Your SendGrid account has been set up. We highly recommend sending a small test campaign to your self to check if
            everything is working as expected.
        </p>
    </div>

    <x-mailcoach::fieldset class="mt-8" :legend="__('Summary')">
        <dl class="dl">
            <dt>Open tracking enabled:</dt>
            <dd>
                {{ $mailer->get('open_tracking_enabled') ? '✅' : '❌' }}
            </dd>

            <dt>Click tracking enabled:</dt>
            <dd>
                {{ $mailer->get('click_tracking_enabled') ? '✅' : '❌' }}
            </dd>
        </dl>
    </x-mailcoach::fieldset>

    <x-mailcoach::fieldset class="mt-8" :legend="__('Throttling')">
         <dl class="dl">
            <dt>Timespan in seconds</dt>
            <dd>
                {{ $mailer->get('timespan_in_seconds') }}
            </dd>

            <dt>Mails per timespan</dt>
            <dd>
                {{ $mailer->get('mails_per_timespan') }}
            </dd>
        </dl>
    </x-mailcoach::fieldset>
</div>
