<?php

namespace Spatie\MailcoachUi\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\TransactionalMailConfigurationDriverRepository;

class UpdateTransactionalMailConfigurationRequest extends FormRequest
{
    public function rules(): array
    {
        $mailConfigurationDriverRepository = new TransactionalMailConfigurationDriverRepository();

        return array_merge([
          'driver' => ['required','bail',  Rule::in($mailConfigurationDriverRepository->getSupportedDrivers())],
        ], $this->getDriverSpecificValidationRules($mailConfigurationDriverRepository));
    }

    public function getDriverSpecificValidationRules(TransactionalMailConfigurationDriverRepository $mailConfigurationDriverRepository): array
    {
        if (! $driver = $mailConfigurationDriverRepository->getForDriver($this->driver ?? '')) {
            return [];
        }

        return $driver->validationRules();
    }
}
