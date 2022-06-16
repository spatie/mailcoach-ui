<div>
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <x-mailcoach::help>
        Mailgun can be configured track bounces and complaints. It will send webhooks to Mailcoach, that will be used to
        automatically unsubscribe people.<br/><br/>Optionally, Mailgun can also send webhooks to inform Mailcoach of opens and
        clicks.
    </x-mailcoach::help>

    <div class="mt-4">


        <form class="form-grid mt-4" wire:submit.prevent="configureMailgun">
            <x-mailcoach::checkbox-field
                :label="__('Enable open tracking')"
                name="trackOpens"
                wire:model.defer="trackOpens"
            />

            <x-mailcoach::checkbox-field
                :label="__('Enable click tracking')"
                name="trackClicks"
                wire:model.defer="trackClicks"
            />

            <x-mailcoach::text-field
                name="signingSecret"
                wire:model.lazy="signingSecret"
                :label="__('Webhook signing secret')"
            />

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Configure Mailgun')"/>
            </div>
        </form>
    </div>
</div>
