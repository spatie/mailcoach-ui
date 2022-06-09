<div>
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <div class="alert alert-success">
        <p>
            Your SendGrid account has been set up. We highly recommend sending a small test campaign to your self to check if
            everything is working as expected.
        </p>
    </div>

    <div class="mt-6 space-y-4">
        <div>
            Open tracking enabled: {{ $mailer->get('open_tracking_enabled') ? '✅' : '❌' }}
        </div>

        <div>
            Click tracking enabled: {{ $mailer->get('click_tracking_enabled') ? '✅' : '❌' }}
        </div>
    </div>
</div>
