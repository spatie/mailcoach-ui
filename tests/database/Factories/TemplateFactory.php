<?php

namespace Spatie\MailcoachUi\Tests\Database\Factories;

use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Mailcoach\Models\Subscriber;
use Spatie\Mailcoach\Models\Template;

class TemplateFactory extends Factory
{
    protected $model = Template::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'html' => $this->faker->randomHtml(),
        ];
    }
}
