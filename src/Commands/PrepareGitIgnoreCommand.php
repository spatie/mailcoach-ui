<?php

namespace Spatie\MailcoachUi\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PrepareGitIgnoreCommand extends Command
{
    protected $signature = 'mailcoach:prepare-git-ignore';

    protected $description = 'Prepare the git ignore file';

    public function handle()
    {
        $gitIgnorePath = base_path('.gitignore');

        $newContent = collect(file(base_path('.gitignore')))
            ->reject(fn (string $line) => Str::startsWith($line, 'composer.lock'))
            ->reject(fn (string $line) => Str::startsWith($line, 'resources/views/vendor'))
            ->implode('');

        file_put_contents($gitIgnorePath, $newContent);

        $this->info('Not ignoring composer.lock and vendor views anymore...');
    }
}
