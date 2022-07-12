<div>
@include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')
<x-mailcoach::card>
    <x-mailcoach::help>
        Postmark can be configured track bounces and complaints. It will send webhooks to Mailcoach, that will be used to
        automatically unsubscribe people.<br/><br/>Optionally, Postmark can also send webhooks to inform Mailcoach of opens and
        clicks.
    </x-mailcoach::help>

        <form class="form-grid" wire:submit.prevent="configurePostmark">
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

            <x-mailcoach::form-buttons>
                <x-mailcoach::button :label="__('Configure Postmark')"/>
        </x-mailcoach::form-buttons>
        </form>
</x-mailcoach::card>
</div>
