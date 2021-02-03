@extends('mailcoach-ui::app.settings.layouts.settings', ['title' => __('Editor')])

@section('main')
    <h1 class="markup-h1">{{ __('Editor') }}</h1>
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
                @include('mailcoach-ui::app.settings.editor.partials.textarea')
            </div>

            <div class="form-grid" data-conditional-editor="Unlayer">
                @include('mailcoach-ui::app.settings.editor.partials.unlayer')
            </div>

            <div class="form-grid" data-conditional-editor="Monaco">
                @include('mailcoach-ui::app.settings.editor.partials.monaco')
            </div>

            <div class="form-buttons">
                <x-mailcoach::button :label="__('Save')"/>
            </div>
        </form>
    </section>
@endsection
