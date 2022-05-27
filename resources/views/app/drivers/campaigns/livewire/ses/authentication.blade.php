<div>
    @include('mailcoach-ui::app.drivers.campaigns.livewire.wizardNavigation')

    <x-mailcoach::help>
        <p>
        To be able to send mails through Amazon SES, we should first authenticate at Amazon.
        </p>
            <p>
            You should first <a href="https://aws.amazon.com">create an account</a> at AWS.
            </p>
                <p>
            Next, <a href="https://spatie.be/docs/laravel-mailcoach/v4/configuring-mail-providers/amazon-ses#content-key-and-secret-sending-emails">create an Access Key ID and Secret Access Key</a>, and fill them in the form below.
            </p>
    </x-mailcoach::help>

    <div class="form-grid mt-4">
        <form class="form-grid" wire:submit.prevent="submit">
            <x-mailcoach::text-field
                wire:model="key"
                :label="__('Key')"
                name="key"
                type="text"
                autocomplete="off"
            />

            <x-mailcoach::text-field
                wire:model="secret"
                :label="__('Secret')"
                name="secret"
                type="password"
                autocomplete="off"
            />

            <x-mailcoach::select-field
                wire:model="region"
                :label="__('Region')"
                name="region"
                :options="$regions"
            />

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Verify')"/>
            </div>
        </form>

    </div>
</div>
