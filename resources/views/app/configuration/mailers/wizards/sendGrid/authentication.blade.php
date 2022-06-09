<div>
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <x-mailcoach::help>
        <p>
        To be able to send mails through Amazon SendGrid, we should first authenticate at Sendgrid.
        </p>
            <p>
            You should first <a href="https://sendgrid.com" target="_blank">create an account</a> at AWS.
            </p>
                <p>
            Next, <a target="_blank" href="https://spatie.be/docs/laravel-mailcoach/v5/configuring-mail-providers/sendgrid#content-email-configuration">create and API key at SendGrid</a>. Make sure it has the "Mail Send" and "Tracking" permissions.
            </p>
    </x-mailcoach::help>

    <div class="form-grid mt-4">
        <form class="form-grid" wire:submit.prevent="submit">
            <x-mailcoach::text-field
                wire:model.defer="apiKey"
                :label="__('API Key')"
                name="apiKey"
                type="text"
                autocomplete="off"
            />

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Verify')"/>
            </div>
        </form>

    </div>
</div>
