<div class="card-grid">
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <x-mailcoach::success>
        <p>
            Your SES account has been set up. We highly recommend sending a small test campaign to yourself to check if
            everything is working as expected.
        </p>
    </x-mailcoach::success>

    @if($isInSandboxMode)
        <x-mailcoach::warning>
            <p>
                Your SES account is currently in sandbox mode. This means that you can only send to emails that are verified with Amazon.
            </p>
        </x-mailcoach::warning>
    @endif

    <x-mailcoach::fieldset card :legend="__('Summary')">
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
                @if ($mailer->get('open_tracking_enabled'))
                    <x-mailcoach::rounded-icon type="success" icon="fas fa-check" />
                @else
                    <x-mailcoach::rounded-icon type="error" icon="fas fa-times" />
                @endif
            </dd>

            <dt>Click tracking enabled:</dt>
            <dd>
                @if ($mailer->get('click_tracking_enabled'))
                    <x-mailcoach::rounded-icon type="success" icon="fas fa-check" />
                @else
                    <x-mailcoach::rounded-icon type="error" icon="fas fa-times" />
                @endif
            </dd>

            <dt>Configuration set name:</dt>
            <dd>
                {{ $mailer->get('ses_configuration_set') }}
            </dd>
        </dl>
    </x-mailcoach::fieldset>

    <x-mailcoach::fieldset card :legend="__('Throttling')">
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

    <x-mailcoach::card buttons>
        <x-mailcoach::button :label="__('Send test email')" x-on:click.prevent="$store.modals.open('send-test')" />
    </x-mailcoach::card>
</div>
