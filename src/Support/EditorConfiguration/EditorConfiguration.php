<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Collection;
use Spatie\MailcoachUi\Support\Concerns\UsesSettings;
use Spatie\MailcoachUi\Support\EditorConfiguration\Editors\EditorConfigurationDriver;

class EditorConfiguration
{
    use UsesSettings;

    public function __construct(
        protected Repository $config,
        protected EditorConfigurationDriverRepository $editorConfigurationRepository
    ) {
    }

    public function registerConfigValues(): void
    {
        $editorName = $this->get('editor');

        if (! $editorName) {
            return;
        }

        if (! $this->getAvailableEditors()->map->label()->contains($editorName)) {
            return;
        }

        $this->getEditor()->registerConfigValues(
            $this->config,
            $this->all()
        );
    }

    /** @return Collection<EditorConfigurationDriver> */
    public function getAvailableEditors(): Collection
    {
        return $this->editorConfigurationRepository->getSupportedEditors();
    }

    public function getEditorOptions(): array
    {
        return $this->getAvailableEditors()->mapWithKeys(function (EditorConfigurationDriver $driver) {
            return [
                $driver->label() => $driver->label(),
            ];
        })->toArray();
    }

    protected function getEditor(): EditorConfigurationDriver
    {
        return $this->editorConfigurationRepository->getForEditor($this->get('editor', ''));
    }

    public function getKeyName(): string
    {
        return 'EditorConfiguration';
    }
}
