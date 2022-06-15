<form
    class="form-grid"
    wire:submit.prevent="save"
    @keydown.prevent.window.cmd.s="$wire.call('save')"
    @keydown.prevent.window.ctrl.s="$wire.call('save')"
    method="POST"
    x-cloak
    x-data="{
        contentEditor: @entangle('contentEditor'),
        templateEditor: @entangle('templateEditor'),
    }"
>
    @csrf

    <x-mailcoach::fieldset :legend="__('Content editor')">
        <x-mailcoach::select-field
            :label="__('Editor')"
            name="contentEditor"
            x-model="contentEditor"
            :options="$contentEditorOptions"
        />
    </x-mailcoach::fieldset>

    <x-mailcoach::fieldset :legend="__('Template editor')">
        <x-mailcoach::select-field
            :label="__('Editor')"
            name="templateEditor"
            x-model="templateEditor"
            :options="$templateEditorOptions"
        />
    </x-mailcoach::fieldset>

    @foreach(config('mailcoach-ui.editors') as $editor)
        @continue($contentEditor !== $editor::label() && $templateEditor !== $editor::label())

        <x-mailcoach::fieldset :legend="$editor::label()">
            <div class="form-grid">
                @includeIf($editor::settingsPartial())
            </div>
        </x-mailcoach::fieldset>
    @endforeach

    <div class="form-buttons">
        <x-mailcoach::button :label="__('Save')"/>
    </div>
</form>
