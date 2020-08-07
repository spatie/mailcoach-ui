<?php

namespace Spatie\MailcoachUi\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ExecuteComposerHookCommand extends Command
{
    public $signature = 'mailcoach:execute-composer-hook';

    public $description = 'Perform tasks that should be executed on composer install / update';

    public function handle()
    {
        $this->info('Executing mailcoach composer hook...');
        $this->info('');

        $commands = [
            'horizon:publish',
            'vendor:publish --tag mailcoach-ui-vendor-views --force',
            'vendor:publish --tag mailcoach-assets --force',
            'vendor:publish --tag mailcoach-monaco-assets --force',
        ];

        collect($commands)->each(function (string $command) {
            $this->comment("Executing `{$command}`...");

            try {
                Artisan::call($command, [], $this->output);
            } catch (Exception $exception) {
                $this->error("Error executing command: `{$exception->getMessage()}`");
            }

            $this->info('');
        });

        $this->info('All done!');
    }
}
