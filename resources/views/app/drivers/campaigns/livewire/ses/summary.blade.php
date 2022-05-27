<div>
    @include('mailcoach-ui::app.drivers.campaigns.livewire.wizardNavigation')

    <div class="alert alert-success">
        <p>
        Your SES account has been set up. We highly recommend sending a small test campaign to your self to check if
        everything is working as expected.
        </p>
        <p>
            Go back to <a href="{{ route('mailConfiguration') }}">Campaign Settings</a>
        </p>
    </div>
</div>
