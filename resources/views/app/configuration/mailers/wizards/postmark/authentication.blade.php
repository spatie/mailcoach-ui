<div>

@include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')
<x-mailcoach::card>

    <x-mailcoach::help>
        <p>
        To be able to send mails through Postmark, we should authenticate at Postmark.
        </p>
            <p>
            You should first <a href="https://postmarkapp.com" target="_blank">create an account</a> at Postmark.
            </p>
                <p>
            Next, <a target="_blank" href="https://spatie.be/docs/laravel-mailcoach/v5/configuring-mail-providers/postmark#content-email-configuration">create a server API token at Postmark</a>.
            </p>
    </x-mailcoach::help>

        <form class="form-grid" wire:submit.prevent="submit">
            <x-mailcoach::text-field
                wire:model.defer="apiKey"
                :label="__('Server API token')"
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
