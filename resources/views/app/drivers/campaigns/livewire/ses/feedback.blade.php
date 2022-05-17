<div>
    @include('mailcoach-ui::app.drivers.campaigns.livewire.wizardNavigation')

    <x-mailcoach::help>
        AWS can be configured track bounces and complaints. It will send webhooks to Mailcoach, that will be used to
        automatically unsubscribe people.<br/><br/>Optionally, AWS can also send webhooks to inform Mailcoach of opens and
        clicks.
    </x-mailcoach::help>

    <div class="mt-4">
    <x-mailcoach::select-field
        wire:model="configurationType"
        name="configuration"
        :label="__('Setup type')"

        :options="['automatic' => 'Automatic', 'manual' => 'Manual']"
    />
    </div>

    <div class="mt-4">
    @if($configurationType === 'manual')
        <div>
            {!! __('Learn how to configure :provider by reading <a target="_blank" href=":docsLink">this section of the Mailcoach docs</a>.', ['provider' => 'SES', 'docsLink' => 'https://spatie.be/docs/laravel-mailcoach/v4/configuring-mail-providers/amazon-ses']) !!}

            <br />

            {!! __('You must set a webhook to: <code class="markup-code">:webhookUrl</code>', ['webhookUrl' => url(action(\Spatie\MailcoachSesFeedback\SesWebhookController::class))]) !!}
        </div>

        <form class="form-grid mt-4" wire:submit.prevent="setupFeedbackManually">
            <x-mailcoach::text-field
                wire:model="configurationName"
                :label="__('Configuration name')"
                name="configurationName"
                type="text"
            />

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Continue')"/>
            </div>
        </form>
    @else
        <div>
            We will automatically set up SES and SNS for you.
        </div>

        <form class="form-grid mt-4" wire:submit.prevent="setupFeedbackAutomatically">
            <x-mailcoach::text-field
                wire:model="configurationName"
                :label="__('Configuration name')"
                name="configurationName"
                type="text"
            />

            <x-mailcoach::checkbox-field
                :label="__('Enable open tracking')"
                name="trackOpens"
                wire:model="trackOpens"
            />

            <x-mailcoach::checkbox-field
                :label="__('Enable click tracking')"
                name="trackClicks"
                wire:model="trackClicks"
            />

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Automatically configure AWS')"/>
            </div>
        </form>
    @endif
    </div>

</div>
