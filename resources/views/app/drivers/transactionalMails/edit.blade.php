<x-mailcoach-ui::layout-settings :title="__('Transactional Mail')">
    <form
        class="form-grid"
        action="{{ route('transactionalMailConfiguration') }}"
        method="POST"
        x-cloak
        x-data="{ driver: '{{ old('driver', $mailConfiguration->driver ?? 'ses') }}' }"
    >
        @csrf
        @method('PUT')

        @if(! $mailConfiguration->isValid())
            <x-mailcoach::warning>
                {{ __("You haven't configured a transactional driver yet. Mailcoach will send confirmation mails and welcome mails using the campaign driver.") }}
            </x-mailcoach::warning>
        @endif

        <x-mailcoach::select-field
            :label="__('Driver')"
            name="driver"
            x-model="driver"
            :options="[
                'ses' => 'Amazon SES',
                'sendgrid' => 'SendGrid',
                'mailgun' => 'Mailgun',
                'postmark' => 'Postmark',
                'postal' => 'Postal',
                'smtp' => 'SMTP',
            ]"
        />

        <div class="form-grid" x-show="driver === 'ses'">
            @include('mailcoach-ui::app.drivers.transactionalMails.partials.ses')
        </div>

        <div class="form-grid" x-show="driver === 'mailgun'">
            @include('mailcoach-ui::app.drivers.transactionalMails.partials.mailgun')
        </div>

        <div class="form-grid" x-show="driver === 'sendgrid'">
            @include('mailcoach-ui::app.drivers.transactionalMails.partials.sendgrid')
        </div>

        <div class="form-grid" x-show="driver === 'postmark'">
            @include('mailcoach-ui::app.drivers.transactionalMails.partials.postmark')
        </div>

        <div class="form-grid" x-show="driver === 'postal'">
            @include('mailcoach-ui::app.drivers.transactionalMails.partials.postal')
        </div>

        <div class="form-grid" x-show="driver === 'smtp'">
            @include('mailcoach-ui::app.drivers.transactionalMails.partials.smtp')
        </div>

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Save configuration')"/>
            @if($mailConfiguration->isValid())
                <x-mailcoach::button-secondary x-on:click="$store.modals.open('send-test')" :label="__('Send Test')" />
            @endif
        </div>
    </form>

    @if($mailConfiguration->isValid())

        <x-mailcoach::modal title="Send Test" name="send-test" :open="$errors->has('to_email') || $errors->has('from_email')">
            @include('mailcoach-ui::app.drivers.transactionalMails.partials.sendTestMail')
        </x-mailcoach::modal>

        <form
            class="mt-8"
            action="{{ route('deleteTransactionalMailConfiguration') }}"
            method="POST"
            data-cloak
        >
            @csrf
            @method('DELETE')
            <div class="form-buttons">
                <button class="text-red-400 hover:text-red-500">
                    <x-mailcoach::icon-label caution="true" icon="far fa-trash-alt" :text="__('Delete configuration')"/>
                </button>
            </div>
        </form>
    @endif
</x-mailcoach-ui::layout-settings>
