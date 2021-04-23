<x-mailcoach::help>
    {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'Postmark', 'docsLink' => 'https://spatie.be/docs/laravel-mailcoach/v4/configuring-mail-providers/postmark']) !!}
</x-mailcoach::help>

<x-mailcoach::text-field
    :label="__('Server Token')"
    name="postmark_token"
    type="password"
    :value="$mailConfiguration->postmark_token"
/>
