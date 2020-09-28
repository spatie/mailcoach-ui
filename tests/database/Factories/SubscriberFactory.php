<?php

namespace Spatie\MailcoachUi\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Mailcoach\Models\Subscriber;

class SubscriberFactory extends Factory
{
    protected $model = Subscriber::class;

    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'email_list_id' => EmailListFactory::new()->create()->id,
        ];
    }
}
