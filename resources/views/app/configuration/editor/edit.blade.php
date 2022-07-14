<form
    class="card-grid"
    wire:submit.prevent="save"
    @keydown.prevent.window.cmd.s="$wire.call('save')"
    @keydown.prevent.window.ctrl.s="$wire.call('save')"
    method="POST"
    x-cloak
>
    @csrf
        <x-mailcoach::fieldset card :legend="__('Content editor')">
            <x-mailcoach::select-field
                    name="contentEditor"
                    wire:model="contentEditor"
                    :options="$contentEditorOptions"
                />

                @foreach(config('mailcoach-ui.editors') as $editor)
                @if($contentEditor === $editor::label())
                        <div class="form-grid">
                            @includeIf($editor::settingsPartial())
                        </div>
                @endif
            @endforeach
        </x-mailcoach::fieldset>

        <x-mailcoach::fieldset card :legend="__('Template editor')">
            <x-mailcoach::select-field
                name="templateEditor"
                wire:model="templateEditor"
                :options="$templateEditorOptions"
            />
            @foreach(config('mailcoach-ui.editors') as $editor)
                @if($templateEditor === $editor::label())
                    @if($templateEditor === $contentEditor)
                        <x-mailcoach::info>
                            {{ __('Uses same settings as the content editor.') }}
                        </x-mailcoach::info>
                    @else
                    <div class="form-grid">
                        @includeIf($editor::settingsPartial())
                    </div>
                    @endif
                @endif
            @endforeach
        </x-mailcoach::fieldset>

        <x-mailcoach::card buttons>
            <x-mailcoach::button :label="__('Save')" />
        </x-mailcoach::card>
</form>
