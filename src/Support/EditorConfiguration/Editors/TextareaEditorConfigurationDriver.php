<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration\Editors;

use Illuminate\Contracts\Config\Repository;
use Spatie\Mailcoach\Support\Editor\TextEditor;

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
}
