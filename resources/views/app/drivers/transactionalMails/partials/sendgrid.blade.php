<x-mailcoach::help>
    {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'SendGrid', 'docsLink' => 'https://spatie.be/docs/laravel-mailcoach/v4/configuring-mail-providers/sendgrid']) !!}
</x-mailcoach::help>

<x-mailcoach::text-field
    :label="__('API key')"
    name="sendgrid_api_key"
    type="password"
    :value="$mailConfiguration->sendgrid_api_key"
/>
