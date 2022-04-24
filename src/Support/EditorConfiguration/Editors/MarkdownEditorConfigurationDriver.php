<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration\Editors;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Validation\Rule;
use Spatie\MailcoachMarkdownEditor\Editor;

class MarkdownEditorConfigurationDriver extends EditorConfigurationDriver
{
    public function label(): string
    {
        return 'Markdown';
    }

    public function getClass(): string
    {
        return Editor::class;
    }

    public function validationRules(): array
    {
        return [
            'initialEditType' => ['required', Rule::in(['markdown', 'wysiwyg'])],
            'previewStyle' => ['required', Rule::in(['vertical', 'tab'])],
            'height' => ['nullable'],
            'placeholder' => ['nullable'],
        ];
    }

    public function registerConfigValues(Repository $config, array $values): void
    {
        parent::registerConfigValues($config, $values);

        config()->set('mailcoach-markdown-editor.options.initialEditType', $values['initialEditType'] ?? 'markdown');
        config()->set('mailcoach-markdown-editor.options.previewStyle', $values['previewStyle'] ?? 'vertical');
        config()->set('mailcoach-markdown-editor.options.height', $values['height'] ?? '600px');
        config()->set('mailcoach-markdown-editor.options.placeholder', $values['placeholder'] ?? 'Start writing...');
    }

    public static function settingsPartial(): ?string
    {
        return 'mailcoach-ui::app.configuration.editor.partials.markdown';
    }
}
