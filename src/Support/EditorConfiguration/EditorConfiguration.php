<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration;

use Illuminate\Contracts\Config\Repository;
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

        if (! in_array($editorName, $this->getAvailableEditors())) {
            return;
        }

        $this->getEditor()->registerConfigValues(
            $this->config,
            $this->valuestore->all()
        );
    }

    public function getAvailableEditors(): array
    {
        $editors = $this->editorConfigurationRepository->getSupportedEditors();

        return array_combine($editors, $editors);
    }

    protected function getEditor(): EditorConfigurationDriver
    {
        return $this->editorConfigurationRepository->getForEditor($this->valuestore->get('editor', ''));
    }
}
