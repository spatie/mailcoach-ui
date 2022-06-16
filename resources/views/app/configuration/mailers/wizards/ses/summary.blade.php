<div>
    <x-mailcoach::success class="mb-4">
        <p>
            Your SES account has been set up. We highly recommend sending a small test campaign to yourself to check if
            everything is working as expected.
        </p>
    </x-mailcoach::success>

    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <x-mailcoach::fieldset class="mt-4" :legend="__('Summary')">
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

    <x-mailcoach::button class="mt-4" :label="__('Send test email')" x-on:click.prevent="$store.modals.open('send-test')" />
    <x-mailcoach::modal name="send-test">
        <livewire:mailcoach-ui::send-test mailer="{{ $mailer->configName() }}" />
    </x-mailcoach::modal>
</div>
