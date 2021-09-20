<?php

namespace Spatie\MailcoachUi\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Mailcoach\Enums\SubscriberImportStatus;
use Spatie\Mailcoach\Models\SubscriberImport;

class SubscriberImportFactory extends Factory
{
    protected $model = SubscriberImport::class;

    public function definition()
    {
        return [
            'status' => SubscriberImportStatus::COMPLETED,
            'email_list_id' => EmailListFactory::new()->create()->id,
            'imported_subscribers_count' => $this->faker->numberBetween(1, 1000),
            'error_count' => $this->faker->numberBetween(1, 5),
        ];
    }
}
