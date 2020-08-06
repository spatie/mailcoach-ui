<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration;

use Spatie\MailcoachUi\Support\EditorConfiguration\Editors\EditorConfigurationDriver;
use Spatie\MailcoachUi\Support\EditorConfiguration\Editors\MonacoEditorConfigurationDriver;
use Spatie\MailcoachUi\Support\EditorConfiguration\Editors\TextareaEditorConfigurationDriver;
use Spatie\MailcoachUi\Support\EditorConfiguration\Editors\UnlayerEditorConfigurationDriver;

class EditorConfigurationDriverRepository
{
    protected array $editors = [
        'Textarea' => TextareaEditorConfigurationDriver::class,
        'Unlayer' => UnlayerEditorConfigurationDriver::class,
        'Monaco' => MonacoEditorConfigurationDriver::class,
    ];

    public function getSupportedEditors(): array
    {
        return array_keys($this->editors);
    }

    public function getForEditor(string $editorLabel): EditorConfigurationDriver
    {
        $configuredEditor = collect($this->editors)
            ->map(fn (string $editorClass) => app($editorClass))
            ->first(fn (EditorConfigurationDriver $editor) => $editor->label() === $editorLabel);

        return $configuredEditor ?? app(TextareaEditorConfigurationDriver::class);
    }
}
