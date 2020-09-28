<?php

namespace Spatie\MailcoachUi\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PersonalAccessToken extends Model
{
    use HasFactory;

    public $guarded = [];

    public $casts = [
        'abilities' => 'array',
    ];

    public function tokenable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): User
    {
        return $this->tokenable;
    }
}
