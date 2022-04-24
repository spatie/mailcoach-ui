<x-mailcoach-ui::layout-settings :title="__('Editor')">
    <form
        class="form-grid"
        action="{{ route('editor') }}"
        method="POST"
        data-cloak
    >
        @csrf

        <x-mailcoach::select-field
            :label="__('Editor')"
            name="editor"
            :value="$editorConfiguration->editor"
            :options="$editorConfiguration->getEditorOptions()"
            data-conditional="editor"
        />

        @foreach(config('mailcoach-ui.editors') as $editor)
            <div class="form-grid" data-conditional-editor="{{ (new $editor)->label() }}">
                @includeIf($editor::settingsPartial())
            </div>
        @endforeach

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Save')"/>
        </div>
    </form>
</x-mailcoach-ui::layout-settings>
