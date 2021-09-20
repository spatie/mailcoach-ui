<?php

namespace Spatie\MailcoachUi\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Mailcoach\Models\Send;

class SendFactory extends Factory
{
    protected $model = Send::class;

    public function definition()
    {
        return [
            'campaign_id' => CampaignFactory::new()->create()->id,
            'subscriber_id' => SubscriberFactory::new()->create()->id,
        ];
    }
}
