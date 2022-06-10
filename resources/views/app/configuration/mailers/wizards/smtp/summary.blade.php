<div>
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <div class="alert alert-success">
        <p>
            Your SMTP mailer has been set up. We highly recommend sending a small test campaign to your self to check if
            everything is working as expected.
        </p>
    </div>

    <div class="mt-6 space-y-4">
        <div>
            Host: {{ $mailer->get('host') }}
        </div>

        <div>
            Port: {{ $mailer->get('port') }}
        </div>

        <div>
            Username: {{ $mailer->get('username') }}
        </div>

        <div>
            Encryption: {{ $mailer->get('encryption') === '' ? 'None' : $mailer->get('encryption') }}
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
