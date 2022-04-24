<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration\Editors;

use Spatie\Mailcoach\Domain\Shared\Support\Editor\TextEditor;

class TextareaEditorConfigurationDriver extends EditorConfigurationDriver
{
    public function label(): string
    {
        return 'Textarea';
    }

    public function getClass(): string
    {
        return TextEditor::class;
    }

    public function validationRules(): array
    {
        return [];
    }

    public static function settingsPartial(): ?string
    {
        return 'mailcoach-ui::app.configuration.editor.partials.textarea';
    }
}
