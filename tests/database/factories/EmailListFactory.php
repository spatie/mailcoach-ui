<?php

use Faker\Generator;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Spatie\Mailcoach\Models\EmailList::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
        'default_from_email' => $faker->email,
        'default_from_name' => $faker->name,
    ];
});
