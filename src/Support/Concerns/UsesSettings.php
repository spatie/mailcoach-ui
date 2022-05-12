<?php

namespace Spatie\MailcoachUi\Support\Concerns;

use Exception;
use Spatie\MailcoachUi\Models\Setting;

trait UsesSettings
{
    public function put(array $values): self
    {
        Setting::setValues($this->getKeyName(), $values);

        return $this;
    }

    public function all(): array
    {
        return Setting::where('key', $this->getKeyName())->first()?->allValues() ?? [];
    }

    public function empty(): self
    {
        Setting::where('key')->delete();

        return $this;
    }

    public function __get(string $property)
    {
        return $this->get($property);
    }

    public function get(string $property, mixed $default = null): mixed
    {
        try {
            return Setting::where('key', $this->getKeyName())->first()?->getValue($property) ?? $default;
        } catch (Exception) {
            return $default;
        }
    }

    abstract public function getKeyName(): string;
}
