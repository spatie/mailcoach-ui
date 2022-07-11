<?php

namespace Spatie\MailcoachUi;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Spatie\Flash\Flash;
use Spatie\MailcoachUi\Commands\ExecuteComposerHookCommand;
use Spatie\MailcoachUi\Commands\MakeUserCommand;
use Spatie\MailcoachUi\Commands\PrepareGitIgnoreCommand;
use Spatie\MailcoachUi\Http\App\ViewComposers\HealthViewComposer;
use Spatie\MailcoachUi\Models\PersonalAccessToken;
use Spatie\MailcoachUi\Models\User;
use Spatie\MailcoachUi\Policies\PersonalAccessTokenPolicy;
use Spatie\MailcoachUi\Support\AppConfiguration\AppConfiguration;
use Spatie\MailcoachUi\Support\EditorConfiguration\EditorConfiguration;
use Spatie\MailcoachUi\Support\EditorConfiguration\EditorConfigurationDriverRepository;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfiguration;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfigurationDriverRepository;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\TransactionalMailConfiguration;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\TransactionalMailConfigurationDriverRepository;
use Spatie\Valuestore\Valuestore;

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
                __DIR__ . '/../database/migrations/create_mailcoach_ui_tables.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_mailcoach_ui_tables.php'),
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
        Route::postmarkFeedback('postmark-feedback');
        //Route::postalFeedback('postal-feedback');

        Route::macro('mailcoachUi', function (string $url = '') {
            Route::mailcoach($url);
            Route::mailcoachUnlayer('mailcoachUnlayer');
            Route::mailcoachMarkdownEditor('mailcoachMarkdownEditor');
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

        $this
            ->registerAppConfiguration()
            ->registerMailConfiguration()
            ->registerTransactionalMailConfiguration()
            ->registerEditorConfiguration();
    }

    protected function registerAppConfiguration(): self
    {
        $this->app->bind(AppConfiguration::class, function () {
            /** @var class-string<ValueStore> $valueStoreClass */
            $valueStoreClass = config('mailcoach-ui.valuestore', Valuestore::class);
            $valueStore = $valueStoreClass::make(base_path('config-mailcoach-app/app.json'));

            return new AppConfiguration(
                $valueStore,
                app()->get('config'),
            );
        });

        return $this;
    }

    protected function registerTransactionalMailConfiguration(): self
    {
        $this->app->bind(TransactionalMailConfiguration::class, function () {
            /** @var class-string<ValueStore> $valueStoreClass */
            $valueStoreClass = config('mailcoach-ui.valuestore', Valuestore::class);
            $valueStore = $valueStoreClass::make(base_path('config-mailcoach-app/transactional-mail.json'));

            return new TransactionalMailConfiguration(
                $valueStore,
                app()->get('config'),
                new TransactionalMailConfigurationDriverRepository()
            );
        });

        return $this;
    }

    protected function registerMailConfiguration(): self
    {
        $this->app->bind(MailConfiguration::class, function () {
            /** @var class-string<ValueStore> $valueStoreClass */
            $valueStoreClass = config('mailcoach-ui.valuestore', Valuestore::class);
            $valueStore = $valueStoreClass::make(base_path('config-mailcoach-app/mail.json'));

            return new MailConfiguration(
                $valueStore,
                app()->get('config'),
                new MailConfigurationDriverRepository()
            );
        });

        return $this;
    }

    protected function registerEditorConfiguration(): self
    {
        $this->app->bind(EditorConfiguration::class, function () {
            /** @var class-string<ValueStore> $valueStoreClass */
            $valueStoreClass = config('mailcoach-ui.valuestore', Valuestore::class);
            $valueStore = $valueStoreClass::make(base_path('config-mailcoach-app/editor.json'));

            return new EditorConfiguration(
                $valueStore,
                app()->get('config'),
                new EditorConfigurationDriverRepository()
            );
        });

        return $this;
    }
}
