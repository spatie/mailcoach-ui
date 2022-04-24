<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Collection;
use Spatie\MailcoachUi\Support\EditorConfiguration\Editors\EditorConfigurationDriver;
use Spatie\Valuestore\Valuestore;

class EditorConfiguration
{
    private Valuestore $valuestore;

    private Repository $config;

    private EditorConfigurationDriverRepository $editorConfigurationRepository;

    public function __construct(
        Valuestore $valuestore,
        Repository $config,
        EditorConfigurationDriverRepository $editorConfigurationRepository
    ) {
        $this->valuestore = $valuestore;

        $this->config = $config;

        $this->editorConfigurationRepository = $editorConfigurationRepository;
    }

    public function put(array $values)
    {
        $this->valuestore->flush();

        return $this->valuestore->put($values);
    }

    public function all()
    {
        return $this->valuestore->all();
    }

    public function __get(string $property)
    {
        return $this->valuestore->get($property);
    }

    public function registerConfigValues(): void
    {
        $editorName = $this->valuestore->get('editor');

        if (! $editorName) {
            return;
        }

        if (! $this->getAvailableEditors()->map->label()->contains($editorName)) {
            return;
        }

        $this->getEditor()->registerConfigValues(
            $this->config,
            $this->valuestore->all()
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
        return $this->editorConfigurationRepository->getForEditor($this->valuestore->get('editor', ''));
    }
}
