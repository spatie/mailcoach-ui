<?php

namespace Spatie\MailcoachUi\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Mailcoach\Models\EmailList;

class EmailListFactory extends Factory
{
    protected $model = EmailList::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'default_from_email' => $this->faker->email,
            'default_from_name' => $this->faker->name,
        ];
    }
}
