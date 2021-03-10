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
            :options="$editorConfiguration->getAvailableEditors()"
            data-conditional="editor"
        />

        <div class="form-grid" data-conditional-editor="Textarea">
            @include('mailcoach-ui::app.configuration.editor.partials.textarea')
        </div>

        <div class="form-grid" data-conditional-editor="Unlayer">
            @include('mailcoach-ui::app.configuration.editor.partials.unlayer')
        </div>

        <div class="form-grid" data-conditional-editor="Monaco">
            @include('mailcoach-ui::app.configuration.editor.partials.monaco')
        </div>

        <div class="form-buttons">
            <x-mailcoach::button :label="__('Save')"/>
        </div>
    </form>
</x-mailcoach-ui::layout-settings>