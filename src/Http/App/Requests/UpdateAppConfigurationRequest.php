<?php

namespace Spatie\MailcoachUi\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\MailcoachUi\Support\TimeZone;

class UpdateAppConfigurationRequest extends FormRequest
{
    public function rules(): array
    {
        return array_merge([
            'name' => ['required'],
            'timezone' => ['required', Rule::in(TimeZone::all())],
            'url' => ['required', 'url'],
        ]);
    }
}
