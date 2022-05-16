<?php

namespace Spatie\MailcoachUi;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Livewire\Livewire;
use Spatie\Flash\Flash;
use Spatie\MailcoachUi\Commands\ExecuteComposerHookCommand;
use Spatie\MailcoachUi\Commands\MakeUserCommand;
use Spatie\MailcoachUi\Commands\PrepareGitIgnoreCommand;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\SesMailConfigurationComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\FirstStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\SecondStepComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\Steps\ThirdStepComponent;
use Spatie\MailcoachUi\Http\App\ViewComposers\HealthViewComposer;
use Spatie\MailcoachUi\Http\Livewire\CreateUserComponent;
use Spatie\MailcoachUi\Models\PersonalAccessToken;
use Spatie\MailcoachUi\Models\User;
use Spatie\MailcoachUi\Policies\PersonalAccessTokenPolicy;
use Spatie\MailcoachUi\Support\AppConfiguration\AppConfiguration;
use Spatie\MailcoachUi\Support\EditorConfiguration\EditorConfiguration;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfiguration;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\TransactionalMailConfiguration;

class MailcoachUiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('mailcoach-ui::app.layouts.partials.health', HealthViewComposer::class);

        $this
            ->bootConfig()
            ->bootPublishables()
            ->bootAuthorization()
            ->bootFlash()
            ->bootRoutes()
            ->bootCommands()
            ->bootViews();
    }

    protected function bootConfig(): self
    {
        app(AppConfiguration::class)->registerConfigValues();
        app(TransactionalMailConfiguration::class)->registerConfigValues();
        app(MailConfiguration::class)->registerConfigValues();
        app(EditorConfiguration::class)->registerConfigValues();

        return $this;
    }

    protected function bootPublishables()
    {
        $this->publishes([
            __DIR__ . '/../config/mailcoach-ui.php' => config_path('mailcoach-ui.php'),
        ], 'mailcoach-ui-config');

        $this->publishes([
            __DIR__ . '/../resources/views-vendor' => resource_path('views/vendor'),
        ], 'mailcoach-ui-vendor-views');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/mailcoach-ui'),
        ], 'mailcoach-ui-views');

        if (! class_exists('CreateMailcoachUiTables')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_mailcoach_ui_tables.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_mailcoach_ui_tables.php'),
            ], 'mailcoach-ui-migrations');
        }

        return $this;
    }

    protected function bootAuthorization(): self
    {
        Gate::define('viewMailcoach', fn (User $user) => true);

        Gate::policy(PersonalAccessToken::class, PersonalAccessTokenPolicy::class);

        return $this;
    }

    protected function bootFlash(): self
    {
        Flash::levels([
            'success' => 'success',
            'warning' => 'warning',
            'error' => 'error',
        ]);

        return $this;
    }

    protected function bootCommands(): self
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ExecuteComposerHookCommand::class,
                MakeUserCommand::class,
                PrepareGitIgnoreCommand::class,
            ]);
        }

        return $this;
    }

    protected function bootRoutes()
    {
        Route::sesFeedback('ses-feedback');
        Route::mailgunFeedback('mailgun-feedback');
        Route::sendgridFeedback('sendgrid-feedback');
        //Route::postmarkFeedback('postmark-feedback');
        //Route::postalFeedback('postal-feedback');

        Route::macro('mailcoachUi', function (string $url = '') {
            Route::mailcoach($url);
            Route::mailcoachEditor('mailcoachEditor');

            Route::redirect($url, $url.'/'.config('mailcoach-ui.url_after_login') ?? 'campaigns');

            Route::prefix($url)
                ->middleware(config('mailcoach-ui.middleware'))
                ->group(function () {
                    require(__DIR__ . '/../routes/auth.php');

                    Route::middleware('auth')->group(__DIR__ . '/../routes/mailcoach-ui.php');
                });
        });

        URL::forceRootUrl(config('app.url'));

        return $this;
    }

    protected function bootViews(): self
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'mailcoach-ui');

        if (config("mailcoach.views.use_blade_components", true)) {
            $this->bootBladeComponents();
        }

        Livewire::component('mailcoach-ui::create-user', CreateUserComponent::class);
        Livewire::component('mailcoach-ui::ses-configuration', SesMailConfigurationComponent::class);

        Livewire::component('mailcoach-ui::step-1', FirstStepComponent::class);
        Livewire::component('mailcoach-ui::step-2', SecondStepComponent::class);
        Livewire::component('mailcoach-ui::step-3', ThirdStepComponent::class);

        return $this;
    }

    protected function bootBladeComponents(): self
    {
        Blade::component('mailcoach-ui::auth.layouts.auth', 'mailcoach-ui::layout-auth');
        Blade::component('mailcoach-ui::app.layouts.settings', 'mailcoach-ui::layout-settings');

        return $this;
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/mailcoach-ui.php', 'mailcoach-ui');
    }
}
