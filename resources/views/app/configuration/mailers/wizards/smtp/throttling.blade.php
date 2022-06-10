<div>
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <x-mailcoach::help>
        In order not to overwhelm your SMTP server with send requests, Mailcoach can throttle the amount of mails sent.
    </x-mailcoach::help>

    <div class="form-grid mt-4">
        <form class="form-grid" wire:submit.prevent="submit">

            <x-mailcoach::text-field
                wire:model.defer="timespanInSeconds"
                :label="__('Timespan in seconds')"
                name="timespanInSeconds"
                type="number"
            />

            <x-mailcoach::text-field
                wire:model.defer="mailsPerTimeSpan"
                :label="__('Mails per timespan')"
                name="mailsPerTimeSpan"
                type="number"
            />

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Save')"/>
            </div>
        </form>

    </div>
</div>
