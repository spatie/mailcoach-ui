<?php

namespace Spatie\MailcoachUi;

use Illuminate\Support\ServiceProvider;
use Spatie\MailcoachUi\Commands\MailcoachUiCommand;

class MailcoachUiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/mailcoach-ui.php' => config_path('mailcoach-ui.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/mailcoach-ui'),
            ], 'views');

            if (! class_exists('CreatePackageTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_mailcoach_ui_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_mailcoach_ui_table.php'),
                ], 'migrations');
            }

            $this->commands([
                MailcoachUiCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mailcoach-ui');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mailcoach-ui.php', 'mailcoach-ui');
    }
}
