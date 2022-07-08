<x-mailcoach::info>
    {!! __('<a href=":link">Toast UI Editor</a> is a beautiful markdown editor. It also offers image uploads.', ['link' => 'https://ui.toast.com/tui-editor']) !!}
</x-mailcoach::info>

<x-mailcoach::warning>
    {{ __('The Markdown editor stores content in a structured way. When switching from or to this editor, content in existing templates and draft campaigns will get lost.') }}
</x-mailcoach::warning>

<x-mailcoach::select-field
    :label="__('Initial Edit type')"
    name="editorSettings.markdown_initialEditType"
    wire:model.lazy="editorSettings.markdown_initialEditType"
    :options="['markdown' => 'Markdown', 'wysiwyg' => 'Wysiwyg']"
/>
<div class="form-row">
    <x-mailcoach::select-field
        :label="__('Preview style')"
        name="editorSettings.markdown_previewStyle"
        wire:model.lazy="editorSettings.markdown_previewStyle"
        :options="['vertical' => 'Vertical', 'tab' => 'Tab']"
    />

    <x-mailcoach::text-field
        :label="__('Height')"
        name="editorSettings.markdown_height"
        wire:model.lazy="editorSettings.markdown_height"
    />

    <x-mailcoach::text-field
        :label="__('Placeholder')"
        name="editorSettings.markdown_placeholder"
        wire:model.lazy="editorSettings.markdown_placeholder"
    />
</div>
