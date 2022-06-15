<div>
    <x-mailcoach::success class="mb-4">
        <p>
            Your SMTP mailer has been set up. We highly recommend sending a small test campaign to your self to check if
            everything is working as expected.
        </p>
    </x-mailcoach::success>

    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <x-mailcoach::fieldset class="mt-4" :legend="__('Summary')">
        <dl class="dl">
            <dt>Host</dt>
            <dd>
                {{ $mailer->get('host') }}
            </dd>

            <dt>Port</dt>
            <dd>
                {{ $mailer->get('port') }}
            </dd>

            <dt>Username</dt>
            <dd>
                {{ $mailer->get('username') }}
            </dd>

            <dt>Encryption</dt>
            <dd>
                {{ $mailer->get('encryption') === '' ? 'None' : $mailer->get('encryption') }}
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
