<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration\Editors;

use Spatie\MailcoachUnlayer\UnlayerEditor;

class UnlayerEditorConfigurationDriver extends EditorConfigurationDriver
{
    public function label(): string
    {
        return 'Unlayer';
    }

    public function getClass(): string
    {
        return UnlayerEditor::class;
    }

    public function validationRules(): array
    {
        return [];
    }
}
