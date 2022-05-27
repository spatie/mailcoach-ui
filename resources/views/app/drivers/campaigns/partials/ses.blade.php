<x-mailcoach::help>
    <p>
        {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'SES', 'docsLink' => 'https://spatie.be/docs/laravel-mailcoach/v4/configuring-mail-providers/amazon-ses']) !!}
    </p>
    <p>
        Alternatively, you can run <a href="{{ route('wizard.campaign.ses') }}">our setup wizard</a> which can
        automatically configure your SES account.
    </p>
    <p>
        {!! __('You must set a webhook to: <code class="markup-code">:webhookUrl</code>', ['webhookUrl' => url(action(\Spatie\MailcoachSesFeedback\SesWebhookController::class))]) !!}
    </p>
</x-mailcoach::help>

<x-mailcoach::text-field
    :label="__('Key')"
    name="ses_key"
    type="password"
    :value="$mailConfiguration->ses_key"
/>

<x-mailcoach::text-field
    :label="__('Secret')"
    name="ses_secret"
    type="password"
    :value="$mailConfiguration->ses_secret"
/>

<x-mailcoach::text-field
    :label="__('Region')"
    name="ses_region"
    type="text"
    :value="$mailConfiguration->ses_region"
/>

<x-mailcoach::text-field
    :label="__('Configuration set name')"
    name="ses_configuration_set"
    type="text"
    :value="$mailConfiguration->ses_configuration_set"
/>
