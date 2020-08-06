<?php

namespace Spatie\MailcoachUi\Tests\Feature\Controllers\Auth;

use Spatie\MailcoachUi\Http\Auth\Controllers\LoginController;
use Spatie\MailcoachUi\Http\Auth\Controllers\LogoutController;
use Spatie\MailcoachUi\Models\User;
use Spatie\MailcoachUi\Tests\TestCase;

class LogoutControllerTest extends TestCase
{
    /** @test */
    public function it_can_logout()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $this->assertTrue($this->isAuthenticated());

        $this
            ->post(action(LogoutController::class))
            ->assertRedirect(action([LoginController::class, 'showLoginForm']));
        $this->assertFalse($this->isAuthenticated());
    }
}
