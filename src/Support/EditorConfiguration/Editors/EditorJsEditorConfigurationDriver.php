<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration\Editors;

use Spatie\MailcoachEditor\Editor;

class EditorJsEditorConfigurationDriver extends EditorConfigurationDriver
{
    public function label(): string
    {
        return 'Editor.js';
    }

    public function getClass(): string
    {
        return Editor::class;
    }

    public function validationRules(): array
    {
        return [];
    }

    public static function settingsPartial(): ?string
    {
        return 'mailcoach-ui::app.configuration.editor.partials.editor';
    }
}
