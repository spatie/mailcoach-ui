<div>
    <x-mailcoach::help>
        {!! __('<a href=":link">Toast UI Editor</a> is a beautiful markdown editor. It also offers image uploads.', ['link' => 'https://ui.toast.com/tui-editor']) !!}
    </x-mailcoach::help>

    <div class="my-6">
        <x-mailcoach::warning>
            {{ __('The Markdown editor stores content in a structured way. When switching from or to this editor, content in existing templates and draft campaigns will get lost.') }}
        </x-mailcoach::warning>
    </div>

    <div class="my-4">
        <x-mailcoach::select-field
            :label="__('Initial Edit type')"
            name="initialEditType"
            :value="$editorConfiguration->initialEditType"
            :options="['markdown' => 'Markdown', 'wysiwyg' => 'Wysiwyg']"
        />
    </div>

    <div class="my-4">
        <x-mailcoach::select-field
            :label="__('Preview style')"
            name="previewStyle"
            :value="$editorConfiguration->previewStyle"
            :options="['vertical' => 'Vertical', 'tab' => 'Tab']"
        />
    </div>

    <div class="my-4">
        <x-mailcoach::text-field
            :label="__('Height')"
            name="height"
            :value="$editorConfiguration->height ?? '600px'"
        />
    </div>

    <div class="my-4">
        <x-mailcoach::text-field
            :label="__('Placeholder')"
            name="placeholder"
            :value="$editorConfiguration->placeholder ?? 'Start writing...'"
        />
    </div>
</div>
