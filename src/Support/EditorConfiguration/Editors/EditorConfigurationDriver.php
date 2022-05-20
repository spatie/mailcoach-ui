<?php

namespace Spatie\MailcoachUi\Support\EditorConfiguration\Editors;

use Illuminate\Contracts\Config\Repository;

abstract class EditorConfigurationDriver
{
    abstract public static function label(): string;

    /** @return class-string<\Spatie\Mailcoach\Http\Livewire\EditorComponent> */
    abstract public function getClass(): string;

    abstract public function validationRules(): array;

    public function defaults()
    {
        return [];
    }

    public function registerConfigValues(Repository $config, array $values): void
    {
    }

    public static function supportsContent(): bool
    {
        return (new static)->getClass()::$supportsContent;
    }

    public static function supportsTemplates(): bool
    {
        return (new static)->getClass()::$supportsTemplates;
    }

    public static function settingsPartial(): ?string
    {
        return null;
    }
}
