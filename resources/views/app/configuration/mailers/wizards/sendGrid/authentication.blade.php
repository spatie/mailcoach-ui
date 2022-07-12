<div>
@include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')
<x-mailcoach::card>
    <x-mailcoach::help>
        <p>
        To be able to send mails through SendGrid, we should authenticate at Sendgrid.
        </p>
            <p>
            You should first <a href="https://sendgrid.com" target="_blank">create an account</a> at SendGrid.
            </p>
                <p>
            Next, <a target="_blank" href="https://spatie.be/docs/laravel-mailcoach/v5/configuring-mail-providers/sendgrid#content-email-configuration">create and API key at SendGrid</a>. Make sure it has the "Mail Send" and "Tracking" permissions.
            </p>
    </x-mailcoach::help>

    <form class="form-grid" wire:submit.prevent="submit">
        <x-mailcoach::text-field
            wire:model.defer="apiKey"
            :label="__('API Key')"
            name="apiKey"
            type="text"
            autocomplete="off"
        />

        <x-mailcoach::form-buttons>
            <x-mailcoach::button :label="__('Verify')"/>
        </x-mailcoach::form-buttons>
    </form>
</x-mailcoach::card>
</div>
