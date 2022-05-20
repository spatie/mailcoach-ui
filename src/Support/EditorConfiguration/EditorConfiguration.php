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
        $contentEditorName = $this->get('contentEditor');
        $templateEditorName = $this->get('templateEditor');

        if (! $contentEditorName && !$templateEditorName) {
            return;
        }

        $contentEditor = $this->getEditor($contentEditorName);
        $templateEditor = $this->getEditor($templateEditorName);

        $this->config->set('mailcoach.content_editor', $contentEditor->getClass());
        $this->config->set('mailcoach.template_editor', $templateEditor->getClass());

        $contentEditor->registerConfigValues(
            $this->config,
            $this->all()
        );

        $templateEditor->registerConfigValues(
            $this->config,
            $this->all()
        );
    }

    /** @return Collection<EditorConfigurationDriver> */
    public function getAvailableEditors(): Collection
    {
        return $this->editorConfigurationRepository->getSupportedEditors();
    }

    public function getContentEditorOptions(): array
    {
        return $this->getAvailableEditors()
            ->filter(fn (EditorConfigurationDriver $driver) => $driver::supportsContent())
            ->mapWithKeys(function (EditorConfigurationDriver $driver) {
                return [
                    $driver->label() => $driver->label(),
                ];
            })->toArray();
    }

    public function getTemplateEditorOptions(): array
    {
        return $this->getAvailableEditors()
            ->filter(fn (EditorConfigurationDriver $driver) => $driver::supportsTemplates())
            ->mapWithKeys(function (EditorConfigurationDriver $driver) {
                return [
                    $driver->label() => $driver->label(),
                ];
            })->toArray();
    }

    protected function getEditor(string $editorName): EditorConfigurationDriver
    {
        return $this->editorConfigurationRepository->getForEditor($editorName);
    }

    public function getKeyName(): string
    {
        return 'EditorConfiguration';
    }
}
