<x-mailcoach::help>
    {!! __('<a href=":link">Monaco</a> is a powerful code editor created by Microsoft. It provides code highlighting, auto completion and much more.', ['link' => 'https://microsoft.github.io/monaco-editor/']) !!}
</x-mailcoach::help>

<x-mailcoach::select-field
    :label="__('Editor')"
    name="editorSettings.monaco_theme"
    wire:model.lazy="editorSettings.monaco_theme"
    :options="['vs-light' => 'vs-light', 'vs-dark' => 'vs-dark']"
/>

<x-mailcoach::text-field
    :label="__('Font family')"
    name="editorSettings.monaco_font_family"
    wire:model.lazy="editorSettings.monaco_font_family"
/>

<div class="form-row">
    <x-mailcoach::text-field
        :label="__('Font size')"
        name="editorSettings.monaco_font_size"
        wire:model.lazy="editorSettings.monaco_font_size"
        type="number"
    />

    <x-mailcoach::text-field
        :label="__('Font weight')"
        name="editorSettings.monaco_font_weight"
        wire:model.lazy="editorSettings.monaco_font_weight"
        type="number"
    />

    <x-mailcoach::text-field
        :label="__('Line height')"
        name="editorSettings.monaco_line_height"
        wire:model.lazy="editorSettings.monaco_line_height"
        type="number"
    />
</div>
