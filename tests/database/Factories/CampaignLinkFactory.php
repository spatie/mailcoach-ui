<?php

namespace Spatie\MailcoachUi\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Mailcoach\Models\CampaignLink;

class CampaignLinkFactory extends Factory
{
    protected $model = CampaignLink::class;

    public function definition()
    {
        return [
            'campaign_id' => CampaignFactory::new()->create()->id,
            'url' => $this->faker->url,
        ];
    }
}
