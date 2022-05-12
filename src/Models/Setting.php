<?php

namespace Spatie\MailcoachUi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    public $table = 'mailcoach_settings';

    public $guarded = [];

    protected static function setValues(string $key, array $values): self
    {
        $value = Crypt::encryptString(json_encode($values));

        static::query()->updateOrInsert([
            'key' => $key,
        ], [
            'value' => $value,
        ]);

        $setting = static::where('key', $key)->first();

        Cache::forget($setting->cacheName());

        return static::where('key', $key)->first();
    }

    public function getValue(string $key): mixed
    {
        return Arr::get($this->allValues(), $key);
    }

    public function allValues(): array
    {
        return Cache::rememberForever($this->cacheName(), function () {
            return json_decode(Crypt::decryptString($this->value), true) ?? [];
        });
    }

    public function cacheName(): string
    {
        return "{$this->key}-values";
    }
}
