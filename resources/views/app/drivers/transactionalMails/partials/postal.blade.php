<x-mailcoach::help>
    <b>Postal Configuration</b>
    <ul>
        <li>Host: set to Your Postal Server address</li>
        <li>Port: set to Your Postal Server port, default: 25</li>
        <li>SMTP Token: set to SMTP Credentials from your Postal Server</li>
    </ul>
</x-mailcoach::help>

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
