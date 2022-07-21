<x-mailcoach::help>
    {{ __('Open and click tracking is not available for the SMTP driver.') }}
</x-mailcoach::help>

<x-mailcoach::text-field
    label="Host"
    name="smtp_host"
    type="text"
    :value="$mailConfiguration->smtp_host"
/>

<x-mailcoach::text-field
    label="Port"
    name="smtp_port"
    type="number"
    :value="$mailConfiguration->smtp_port"
/>

<x-mailcoach::text-field
    label="Username"
    name="smtp_username"
    type="text"
    :value="$mailConfiguration->smtp_username"
/>

<x-mailcoach::text-field
    label="Password"
    name="smtp_password"
    type="password"
    :value="$mailConfiguration->smtp_password"
/>

<x-mailcoach::select-field
    label="Encryption"
    name="smtp_encryption"
    :options="[
        '' => 'None',
        'tls' => 'TLS',
    ]"
    :value="$mailConfiguration->smtp_encryption ?? ''"
/>
