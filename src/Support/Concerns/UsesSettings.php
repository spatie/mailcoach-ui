<?php

namespace Spatie\MailcoachUi\Support\Concerns;

use Exception;
use Illuminate\Support\Arr;
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
        return Setting::where('key', $this->getKeyName())->first()?->value ?? [];
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
            $setting = Setting::where('key', $this->getKeyName())->first();
        } catch (Exception) {
            return null;
        }

        $value = $setting?->value;

        return Arr::get($value, $property, $default);
    }

    abstract public function getKeyName(): string;
}
