<?php

namespace Spatie\MailcoachUi\Tests\Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Mailcoach\Models\Subscriber;
use Spatie\Mailcoach\Models\Tag;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
