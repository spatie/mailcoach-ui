<?php

namespace Spatie\MailcoachUi\Commands;

use Illuminate\Console\Command;

class MailcoachUiCommand extends Command
{
    public $signature = 'mailcoach-ui';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
