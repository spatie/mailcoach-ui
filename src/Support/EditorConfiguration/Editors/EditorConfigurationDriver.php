<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration\Editors;

use Illuminate\Contracts\Config\Repository;

abstract class EditorConfigurationDriver
{
    abstract public function label(): string;

    abstract public function getClass(): string;

    abstract public function validationRules(): array;

    public function registerConfigValues(Repository $config, array $values): void
    {
        $config->set('mailcoach.campaigns.editor', $this->getClass());
        $config->set('mailcoach.automation.editor', $this->getClass());
        $config->set('mailcoach.transactional.editor', $this->getClass());
    }
}
