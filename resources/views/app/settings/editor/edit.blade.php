@extends('mailcoach::app.layouts.app', [
    'title' => __('Editor configuration')
])
@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li>{{ __('Editor') }}</li>
        </ul>
    </nav>
@endsection

@section('content')
    <section class="card card-grid">
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
                <button class="button">
                    <x-mailcoach::icon-label icon="fa-code" :text="__('Save')"/>
                </button>
            </div>
        </form>
    </section>
@endsection
