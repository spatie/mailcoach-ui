<?php

namespace Spatie\MailcoachUi\Tests\Feature\Controllers\Api;

use Spatie\MailcoachUi\Models\User;
use Laravel\Sanctum\Sanctum;
use Spatie\MailcoachUi\Tests\TestCase;

class UserControllerTest extends TestCase
{
    /** @test */
    public function it_can_use_the_api_via_sanctum()
    {
        $user = factory(User::class)->create();

        Sanctum::actingAs($user, ['*']);

        $this
            ->getJson('api/user')
            ->assertSuccessful()
            ->assertJsonFragment(['email' => $user->email]);
    }
}
