<?php

use Faker\Generator;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\Subscriber;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Subscriber::class, function (Generator $faker) {
    return [
        'email' => $faker->email,
        'email_list_id' => factory(EmailList::class),
    ];
});
