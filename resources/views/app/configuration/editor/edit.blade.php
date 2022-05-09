<x-mailcoach-ui::layout-settings :title="__('Editor')">
    <form
        class="form-grid"
        action="{{ route('editor') }}"
        method="POST"
        x-cloak
        x-data="{ editor: '{{ old('editor', $editorConfiguration->editor) }}' }"
    >
        @csrf

        <x-mailcoach::select-field
            :label="__('Editor')"
            name="editor"
            x-model="editor"
            :options="$editorConfiguration->getEditorOptions()"
            data-conditional="editor"
        />

        @foreach(config('mailcoach-ui.editors') as $editor)
            <div class="form-grid" x-show="editor === '{{ (new $editor)->label() }}'">
                @includeIf($editor::settingsPartial())
            </div>
        @endforeach

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Save')"/>
        </div>
    </form>
</x-mailcoach-ui::layout-settings>
