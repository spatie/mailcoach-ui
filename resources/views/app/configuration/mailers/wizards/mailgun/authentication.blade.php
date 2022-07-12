<div>
@include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

<x-mailcoach::card>

    <x-mailcoach::help>
        <p>
        To be able to send mails through Mailgun, we should authenticate at Mailgun.
        </p>
            <p>
            You should first <a href="https://mailgun.com" target="_blank">create an account</a> at Mailgun.
            </p>
                <p>
            Next, <a target="_blank" href="https://spatie.be/docs/laravel-mailcoach/v5/configuring-mail-providers/mailgun#content-email-configuration">create and API key at Mailgun</a>. Make sure it has the "Mail Send" and "Tracking" permissions.
            </p>
    </x-mailcoach::help>

        <form class="form-grid" wire:submit.prevent="submit">
            <x-mailcoach::text-field
                wire:model.lazy="apiKey"
                :label="__('API Key')"
                name="apiKey"
                type="text"
                autocomplete="off"
            />

            <x-mailcoach::text-field
                wire:model.lazy="domain"
                :label="__('Domain')"
                name="domain"
                type="text"
                autocomplete="off"
            />

            <x-mailcoach::select-field
                wire:model.lazy="baseUrl"
                :label="__('Base URL')"
                name="baseUrl"
                :options="[
                    'api.mailgun.net' => 'api.mailgun.net',
                    'api.eu.mailgun.net' => 'api.eu.mailgun.net',
                ]"
            />

            <x-mailcoach::form-buttons>
                <x-mailcoach::button :label="__('Verify')"/>
            </x-mailcoach::form-buttons>
        </form>

</x-mailcoach::card>
</div>
