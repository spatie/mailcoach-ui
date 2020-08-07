<?php

namespace Spatie\MailcoachUi\Tests\Feature\Commands;

use Spatie\MailcoachUi\Tests\TestCase;

class ExecuteComposerHookCommandTest extends TestCase
{
    /** @test */
    public function it_can_execute_the_composer_hook()
    {
        $this->artisan('mailcoach:execute-composer-hook')->assertExitCode(0);
    }
}
