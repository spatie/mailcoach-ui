<div>
    <livewire:mailcoach-ui::postmark-configuration :mailer="$mailer" />
    <x-mailcoach::modal name="send-test">
        <livewire:mailcoach-ui::send-test mailer="{{ $mailer->configName() }}" />
    </x-mailcoach::modal>
</div>
