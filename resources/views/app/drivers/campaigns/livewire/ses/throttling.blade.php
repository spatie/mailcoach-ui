<div>
    @include('mailcoach-ui::app.drivers.campaigns.livewire.wizardNavigation')

    <x-mailcoach::help>
        In order not to overwhelm SES with send request, Mailcoach can throttle the amount of mails sent.
    </x-mailcoach::help>

    <div class="form-grid mt-4">
        <form class="form-grid" wire:submit.prevent="submit">
            <x-mailcoach::text-field
                wire:model="mailsPerTimespan"
                :label="__('Mails per timespan')"
                name="mailsPerTimespan"
                type="number"
            />

            <x-mailcoach::text-field
                wire:model="timespanInSeconds"
                :label="__('Timespan in seconds')"
                name="timeSpanInSeconds"
                type="number"
            />

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Save')"/>
            </div>
        </form>
    </div>
</div>
