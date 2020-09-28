<?php

namespace Spatie\MailcoachUi\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Mailcoach\Enums\CampaignStatus;
use Spatie\Mailcoach\Models\Campaign;

class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'subject' => $this->faker->sentence,
            'html' => $this->faker->randomHtml(),
            'track_opens' => $this->faker->boolean,
            'track_clicks' => $this->faker->boolean,
            'status' => CampaignStatus::DRAFT,
            'uuid' => $this->faker->uuid,
            'last_modified_at' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'email_list_id' => function () {
                return factory(EmailList::class)->create(['uuid' => (string)Str::uuid()]);
            },
        ];
    }
}
