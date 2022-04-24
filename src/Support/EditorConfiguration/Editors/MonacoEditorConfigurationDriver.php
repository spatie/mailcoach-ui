<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration\Editors;

use Illuminate\Contracts\Config\Repository;
use Spatie\MailcoachMonaco\MonacoEditor;

class MonacoEditorConfigurationDriver extends EditorConfigurationDriver
{
    public function label(): string
    {
        return 'Monaco';
    }

    public function getClass(): string
    {
        return MonacoEditor::class;
    }

    public function validationRules(): array
    {
        return [
            'monaco_theme' => 'required',
            'monaco_font_family' => '',
            'monaco_font_size' => 'required|numeric',
            'monaco_font_weight' => 'required|numeric',
            'monaco_line_height' => 'required|numeric',
        ];
    }

    public function registerConfigValues(Repository $config, array $values): void
    {
        parent::registerConfigValues($config, $values);

        config()->set('mailcoach.monaco.theme', $values['monaco_theme'] ?? 'vs-light');
        config()->set('mailcoach.monaco.fontFamily', $values['monaco_font_family'] ?? 'Menlo, Monaco, "Courier New", monospace');
        config()->set('mailcoach.monaco.fontSize', $values['monaco_font_size'] ?? '12');
        config()->set('mailcoach.monaco.fontWeight', $values['monaco_font_weight'] ?? '400');
        config()->set('mailcoach.monaco.lineHeight', $values['monaco_line_height'] ?? '18');
    }

    public static function settingsPartial(): ?string
    {
        return 'mailcoach-ui::app.configuration.editor.partials.monaco';
    }
}
