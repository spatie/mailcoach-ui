<?php

namespace Spatie\MailcoachUi\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $table = 'mailcoach_settings';

    public $guarded = [];

    public $casts = [
        'value' => 'array',
    ];

    protected static function setValues(string $key, array $values): self
    {
        static::query()->updateOrInsert([
            'key' => $key,
        ], [
            'value' => json_encode($values),
        ]);

        return static::where('key', $key)->first();
    }
}
