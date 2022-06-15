<div>
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <div class="alert alert-success">
        <p>
            Your SES account has been set up. We highly recommend sending a small test campaign to your self to check if
            everything is working as expected.
        </p>
    </div>

    <x-mailcoach::fieldset class="mt-8" :legend="__('Summary')">
        <dl class="dl">
            <dt>Access Key:</dt>
            <dd>
                {{ $mailer->get('ses_key') }}
            </dd>

            <dt>Region:</dt>
            <dd>
                {{ $mailer->get('ses_region') }}
            </dd>

            <dt>Open tracking enabled:</dt>
            <dd>
                {{ $mailer->get('open_tracking_enabled') }}
            </dd>

            <dt>Click tracking enabled:</dt>
            <dd>
                {{ $mailer->get('click_tracking_enabled') }}
            </dd>

            <dt>Configuration set name:</dt>
            <dd>
                {{ $mailer->get('ses_configuration_set') }}
            </dd>

            <dt>Default from mail:</dt>
            <dd>
                {{ $mailer->get('default_from_mail') }}
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
