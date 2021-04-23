<x-mailcoach::help>
    {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'Mailgun', 'docsLink' => 'https://spatie.be/docs/laravel-mailcoach/v4/configuring-mail-providers/mailgun']) !!}
</x-mailcoach::help>

<x-mailcoach::text-field
    :label="__('Domain')"
    name="mailgun_domain"
    type="text"
    :value="$mailConfiguration->mailgun_domain"
/>

<x-mailcoach::text-field
    :label="__('Secret')"
    name="mailgun_secret"
    type="password"
    :value="$mailConfiguration->mailgun_secret"
/>

<x-mailcoach::text-field
    :label="__('Endpoint')"
    name="mailgun_endpoint"
    type="text"
    :value="$mailConfiguration->mailgun_endpoint"
/>
