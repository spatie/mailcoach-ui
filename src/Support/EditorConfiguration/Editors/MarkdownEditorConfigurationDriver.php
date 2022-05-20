<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration\Editors;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Validation\Rule;
use Spatie\MailcoachMarkdownEditor\Editor;

class MarkdownEditorConfigurationDriver extends EditorConfigurationDriver
{
    public static function label(): string
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
            'markdown_initialEditType' => ['required', Rule::in(['markdown', 'wysiwyg'])],
            'markdown_previewStyle' => ['required', Rule::in(['vertical', 'tab'])],
            'markdown_height' => ['nullable'],
            'markdown_placeholder' => ['nullable'],
        ];
    }

    public function defaults()
    {
        return [
            'markdown_initialEditType' => 'markdown',
            'markdown_previewStyle' => 'vertical',
            'markdown_height' => '600px',
            'markdown_placeholder' => 'Start writing...',
        ];
    }

    public function registerConfigValues(Repository $config, array $values): void
    {
        parent::registerConfigValues($config, $values);

        config()->set('mailcoach-markdown-editor.options.initialEditType', $values['markdown_initialEditType'] ?? 'markdown');
        config()->set('mailcoach-markdown-editor.options.previewStyle', $values['markdown_previewStyle'] ?? 'vertical');
        config()->set('mailcoach-markdown-editor.options.height', $values['markdown_height'] ?? '600px');
        config()->set('mailcoach-markdown-editor.options.placeholder', $values['markdown_placeholder'] ?? 'Start writing...');
    }

    public static function settingsPartial(): ?string
    {
        return 'mailcoach-ui::app.configuration.editor.partials.markdown';
    }
}
