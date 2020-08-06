<?php

namespace Spatie\MailcoachUi\Tests\Feature\Controllers\Spatie\MailcoachUi\Account;

use Spatie\MailcoachUi\Http\Spatie\MailcoachUi\Controllers\Settings\Account\AccountController;
use Spatie\MailcoachUi\Tests\TestCase;

class AccountControllerTest extends TestCase
{
    /** @test */
    public function it_can_update_the_properties_of_the_authenticated_user()
    {
        $this->authenticate();

        $newName = 'New name';
        $newEmail = 'new@example.com';

        $this
            ->put(action([AccountController::class, 'update']), [
                'name' => $newName,
                'email' => $newEmail,
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(action([AccountController::class, 'index']));

        $this->assertEquals($newName, auth()->user()->name);
        $this->assertEquals($newEmail, auth()->user()->email);
    }
}
