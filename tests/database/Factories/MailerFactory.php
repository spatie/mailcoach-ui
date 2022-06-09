<?php

namespace Spatie\MailcoachUi\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\MailcoachUi\Enums\MailerTransport;
use Spatie\MailcoachUi\Models\Mailer;

class MailerFactory extends Factory
{
    protected $model = Mailer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'transport' => MailerTransport::Ses,
        ];
    }
}
