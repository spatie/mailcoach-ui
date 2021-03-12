<?php

namespace Spatie\MailcoachUi\Tests\Feature\Commands;

use Illuminate\Support\Facades\Hash;
use Spatie\MailcoachUi\Models\User;
use Spatie\MailcoachUi\Tests\TestCase;

class MakeUserCommandTest extends TestCase
{
    /** @test * */
    public function it_can_create_a_user()
    {
        $this->artisan('mailcoach:make-user')
            ->expectsQuestion('What is the user\'s name?', 'John')
            ->expectsQuestion('What is the email address?', 'admin@mailcoach.app')
            ->expectsQuestion('What is the password?', 'password')
            ->expectsOutput('User John created!')
            ->assertExitCode(0);

        $this->assertEquals(1, User::count());
        tap(User::first(), function (User $user) {
            $this->assertEquals('John', $user->name);
            $this->assertEquals('admin@mailcoach.app', $user->email);
            $this->assertTrue(Hash::check('password', $user->password));
        });
    }

    /** @test * */
    public function it_can_validate_an_empty_create_user_command()
    {
        $this->artisan('mailcoach:make-user')
            ->expectsQuestion('What is the user\'s name?', '')
            ->expectsQuestion('What is the email address?', '')
            ->expectsQuestion('What is the password?', '')
            ->expectsOutput('User not created. See error messages below:')
            ->expectsOutput('The username field is required.')
            ->expectsOutput('The email field is required.')
            ->expectsOutput('The password field is required.')
            ->assertExitCode(1);

        $this->assertEquals(0, User::count());
    }

    /** @test * */
    public function it_can_validate_a_create_user_command()
    {
        $this->artisan('mailcoach:make-user')
            ->expectsQuestion('What is the user\'s name?', 'Freek')
            ->expectsQuestion('What is the email address?', 'FreekAtSpatie')
            ->expectsQuestion('What is the password?', 'secret')
            ->expectsOutput('User not created. See error messages below:')
            ->expectsOutput('The email must be a valid email address.')
            ->expectsOutput('The password must be at least 8 characters.')
            ->assertExitCode(1);

        $this->assertEquals(0, User::count());
    }

    /** @test * */
    public function it_can_validate_a_create_user_command_with_a_non_unique_email()
    {
        $this->artisan('mailcoach:make-user --username=John --email=admin@mailcoach.app --password=secret123')
            ->expectsOutput('User John created!')
            ->assertExitCode(0);

        $this->artisan('mailcoach:make-user')
            ->expectsQuestion('What is the user\'s name?', 'Johnny')
            ->expectsQuestion('What is the email address?', 'admin@mailcoach.app')
            ->expectsQuestion('What is the password?', 'secret123')
            ->expectsOutput('User not created. See error messages below:')
            ->expectsOutput('The email has already been taken.')
            ->assertExitCode(1);

        $this->assertEquals(1, User::count());
    }

    /** @test * */
    public function it_can_create_a_user_with_options()
    {
        $this->artisan('mailcoach:make-user --username=John --email=admin@mailcoach.app --password=password')
            ->expectsOutput('User John created!')
            ->assertExitCode(0);

        $this->assertEquals(1, User::count());
        tap(User::first(), function (User $user) {
            $this->assertEquals('John', $user->name);
            $this->assertEquals('admin@mailcoach.app', $user->email);
            $this->assertTrue(Hash::check('password', $user->password));
        });
    }
}
