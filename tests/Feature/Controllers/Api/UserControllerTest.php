<?php

namespace Spatie\MailcoachUi\Tests\Feature\Controllers\Api;

use Laravel\Sanctum\Sanctum;
use Spatie\MailcoachUi\Models\User;
use Spatie\MailcoachUi\Tests\TestCase;

class UserControllerTest extends TestCase
{
    /** @test */
    public function it_can_use_the_api_via_sanctum()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['*'], 'api');

        $this
            ->getJson('api/user')
            ->assertSuccessful()
            ->assertJsonFragment(['email' => $user->email]);
    }
}
