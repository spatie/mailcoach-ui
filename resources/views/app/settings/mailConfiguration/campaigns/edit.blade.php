@extends('mailcoach-ui::app.settings.mailConfiguration.layouts.mailConfiguration', ['title' => __('Campaigns Driver')])

@section('mailConfiguration')
    <form
        class="form-grid"
        action="{{ route('mailConfiguration') }}"
        method="POST"
        data-cloak
    >
        @csrf
        @method('PUT')

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
            @include('mailcoach-ui::app.settings.mailConfiguration.campaigns.partials.ses')
        </div>

        <div class="form-grid" data-conditional-driver="mailgun">
            @include('mailcoach-ui::app.settings.mailConfiguration.campaigns.partials.mailgun')
        </div>

        <div class="form-grid" data-conditional-driver="sendgrid">
            @include('mailcoach-ui::app.settings.mailConfiguration.campaigns.partials.sendgrid')
        </div>

        <div class="form-grid" data-conditional-driver="postmark">
            @include('mailcoach-ui::app.settings.mailConfiguration.campaigns.partials.postmark')
        </div>

        <div class="form-grid" data-conditional-driver="smtp">
            @include('mailcoach-ui::app.settings.mailConfiguration.campaigns.partials.smtp')
        </div>

        <x-mailcoach::text-field :label="__('Default from mail')" name="default_from_mail" type="text" :value="$mailConfiguration->default_from_mail"/>

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Save configuration')" />
            <x-mailcoach::button type="button" :secondary="true" dataModalTrigger="send-test" :label="__('Send Test')" />
        </div>

    </form>
    
    <x-mailcoach::modal title="Send Test" name="send-test">
        @include('mailcoach-ui::app.settings.mailConfiguration.campaigns.partials.sendTestMail')
    </x-mailcoach::modal>
@endsection
