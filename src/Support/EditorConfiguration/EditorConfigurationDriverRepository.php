<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration;

use Illuminate\Support\Collection;
use Spatie\MailcoachUi\Support\EditorConfiguration\Editors\EditorConfigurationDriver;
use Spatie\MailcoachUi\Support\EditorConfiguration\Editors\TextareaEditorConfigurationDriver;

class EditorConfigurationDriverRepository
{
    /** @return Collection<EditorConfigurationDriver> */
    public function getSupportedEditors(): Collection
    {
        return collect(config('mailcoach-ui.editors'))
            /** @var class-string<EditorConfigurationDriver> $editorConfigurationDriver */
            ->map(function (string $editorConfigurationDriver) {
                return resolve($editorConfigurationDriver);
            });
    }

    public function getForEditor(string $editorLabel): EditorConfigurationDriver
    {
        $configuredEditor = $this->getSupportedEditors()
            ->first(fn (EditorConfigurationDriver $editor) => $editor->label() === $editorLabel);

        return $configuredEditor ?? app(TextareaEditorConfigurationDriver::class);
    }
}
