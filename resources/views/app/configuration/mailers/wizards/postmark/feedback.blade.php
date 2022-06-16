<div>
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <x-mailcoach::help>
        Postmark can be configured track bounces and complaints. It will send webhooks to Mailcoach, that will be used to
        automatically unsubscribe people.<br/><br/>Optionally, Postmark can also send webhooks to inform Mailcoach of opens and
        clicks.
    </x-mailcoach::help>

    <div class="mt-4">


        <form class="form-grid mt-4" wire:submit.prevent="configurePostmark">
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

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Configure Postmark')"/>
            </div>
        </form>
    </div>
</div>
