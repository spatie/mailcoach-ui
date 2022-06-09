<div>
    @include('mailcoach-ui::app.configuration.mailers.wizards.wizardNavigation')

    <x-mailcoach::help>
        In order to send mail, you need specify a from mail address. AWS will validate the mail address by sending an email to it that contains a confirmation link.
    </x-mailcoach::help>

    <div class="form-grid mt-4">
        <form class="form-grid" wire:submit.prevent="submit">

            <x-mailcoach::text-field
                wire:model.defer="email"
                :label="__('From address')"
                name="email"
                type="email"
            />

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Verify')"/>
            </div>
        </form>

    </div>
</div>
