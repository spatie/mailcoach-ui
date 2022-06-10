<div>
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <div class="alert alert-success">
        <p>
            Your SES account has been set up. We highly recommend sending a small test campaign to your self to check if
            everything is working as expected.
        </p>
    </div>

    <div class="mt-6 space-y-4">
        <div>
            Access Key: {{ $mailer->get('ses_key') }}
        </div>

        <div>
            Region: {{ $mailer->get('ses_region') }}
        </div>

        <div>
            Open tracking enabled: {{ $mailer->get('open_tracking_enabled') }}
        </div>

        <div>
            Click tracking enabled: {{ $mailer->get('click_tracking_enabled') }}
        </div>

        <div>
            Configuration set name: {{ $mailer->get('ses_configuration_set') }}
        </div>

        <div>
            Default from mail: {{ $mailer->get('default_from_mail') }}
        </div>

        <div class="mt-6 space-y-4">
            <div>
                Timespan in seconds: {{ $mailer->get('timespan_in_seconds') }}
            </div>

            <div>
                Mails per timespan: {{ $mailer->get('mails_per_timespan') }}
            </div>
        </div>
    </div>
</div>
