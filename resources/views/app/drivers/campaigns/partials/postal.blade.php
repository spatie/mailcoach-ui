<x-mailcoach::help>
    <b>Postal Configuration</b>
    <ul>
        <li>Host: set to Your Postal Server address</li>
        <li>Port: set to Your Postal Server port, default: 25</li>
        <li>SMTP Token: set to SMTP Credentials from your Postal Server</li>
        <li>Webhook secret: set Webhook secret, default: idcloudhost</li>
    </ul>
    <br>

    {!! __('You must set a webhook to: <code class="markup-code">:webhookUrl</code>', ['webhookUrl' => url(action(\IDCH\MailcoachPostalFeedback\PostalWebhookController::class)) . '?secret=' . $mailConfiguration->postal_secret ]) !!}
</x-mailcoach::help>


<x-mailcoach::text-field
    :label="__('Mails per second')"
    name="postal_mails_per_second"
    type="number"
    :value="$mailConfiguration->postal_mails_per_second ?? 5"
    inputClass="input-sm"
/>

<x-mailcoach::text-field
    :label="__('Host')"
    name="postal_host"
    type="text"
    :value="$mailConfiguration->postal_host"
/>

<x-mailcoach::text-field
    label="Port"
    name="postal_port"
    type="number"
    :value="$mailConfiguration->postal_port ?? 25"
/>

<x-mailcoach::text-field
    :label="__('SMTP Token')"
    name="postal_token"
    type="password"
    :value="$mailConfiguration->postal_token"
/>

<x-mailcoach::text-field
    :label="__('Webhook secret')"
    name="postal_secret"
    type="text"
    :value="$mailConfiguration->postal_secret ?? 'idcloudhost'"
/>
