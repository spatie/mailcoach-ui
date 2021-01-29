@extends('mailcoach-ui::app.settings.transactionalMailConfiguration.layouts.mailConfiguration', ['title' => __('Transactional Mail Configuration')])

@section('breadcrumbs')
    <li>{{ __('Transactional mail configuration') }}</li>
@endsection

@section('mailConfiguration')
    <form
        class="form-grid"
        action="{{ route('transactionalMailConfiguration') }}"
        method="POST"
        data-cloak
    >
        @csrf
        @method('PUT')

        @if(! $mailConfiguration->isValid())
            <x-mailcoach::warning>
                {{ __("You haven't configured a transactional mailer yet. Mailcoach will send confirmation mails and welcome mails using the regular mailer.") }}
            </x-mailcoach::warning>
        @endif

        <x-mailcoach::select-field
            :label="__('Driver')"
            name="driver"
            :value="$mailConfiguration->driver"
            :options="[
                'ses' => 'Amazon SES',
                'sendgrid' => 'SendGrid',
                'mailgun' => 'Mailgun',
                'postmark' => 'Postmark',
                'smtp' => 'SMTP',
            ]"
            data-conditional="driver"
        />

        <div class="form-grid" data-conditional-driver="ses">
            @include('mailcoach-ui::app.settings.transactionalMailConfiguration.partials.ses')
        </div>

        <div class="form-grid" data-conditional-driver="mailgun">
            @include('mailcoach-ui::app.settings.transactionalMailConfiguration.partials.mailgun')
        </div>

        <div class="form-grid" data-conditional-driver="sendgrid">
            @include('mailcoach-ui::app.settings.transactionalMailConfiguration.partials.sendgrid')
        </div>

        <div class="form-grid" data-conditional-driver="postmark">
            @include('mailcoach-ui::app.settings.transactionalMailConfiguration.partials.postmark')
        </div>

        <div class="form-grid" data-conditional-driver="smtp">
            @include('mailcoach-ui::app.settings.transactionalMailConfiguration.partials.smtp')
        </div>

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Save configuration')"/>
        </div>
    </form>

    @if($mailConfiguration->isValid())
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
                    <x-mailcoach::icon-label caution="true" icon="far fa-trash" :text="__('Delete configuration')"/>
                </button>
            </div>
        </form>
    @endif
@endsection

