<div>
    <x-mailcoach::help>
        {!! __('<a href=":link">Editor.js</a> is a beautiful block based wysiwyg editor. It also offers image uploads.', ['link' => 'https://editorjs.io']) !!}
    </x-mailcoach::help>

    <div class="mt-6">
        <x-mailcoach::warning>
            {{ __('Editor.js stores content in a structured way. When switching from or to Editor.js, content in existing templates and draft campaigns will get lost.') }}
        </x-mailcoach::warning>
    </div>
</div>
