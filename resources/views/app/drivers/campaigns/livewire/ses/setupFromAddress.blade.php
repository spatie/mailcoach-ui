<div>
    @include('mailcoach-ui::app.drivers.campaigns.livewire.wizardNavigation')

    <x-mailcoach::help>
        To be able to send mails through Amazon SES, we should first authenticate at Amazon.
    </x-mailcoach::help>

    <div class="form-grid mt-4">
        <form class="form-grid" wire:submit.prevent="submit">


            <x-mailcoach::text-field
                wire:model="key"
                :label="__('Key')"
                name="key"
                type="password"
            />

            <x-mailcoach::text-field
                wire:model="secret"
                :label="__('Secret')"
                name="secret"
                type="password"
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
