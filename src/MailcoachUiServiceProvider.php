<?php

namespace Spatie\MailcoachUi;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Database\QueryException;
use Illuminate\Encryption\Encrypter;
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
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendGrid\SendGridSetupWizardComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\SendTest;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Ses\SesSetupWizardComponent;
use Spatie\MailcoachUi\Http\App\Livewire\Settings\MailConfiguration\Smtp\SmtpSetupWizardComponent;
use Spatie\MailcoachUi\Http\App\ViewComposers\HealthViewComposer;
use Spatie\MailcoachUi\Http\Livewire\CreateMailerComponent;
use Spatie\MailcoachUi\Http\Livewire\CreateUserComponent;
use Spatie\MailcoachUi\Http\Livewire\EditorSettings;
use Spatie\MailcoachUi\Http\Livewire\GeneralSettings;
use Spatie\MailcoachUi\Http\Livewire\Mailers;
use Spatie\MailcoachUi\Models\Mailer;
use Spatie\MailcoachUi\Models\PersonalAccessToken;
use Spatie\MailcoachUi\Models\User;
use Spatie\MailcoachUi\Policies\PersonalAccessTokenPolicy;
use Spatie\MailcoachUi\Support\AppConfiguration\AppConfiguration;
use Spatie\MailcoachUi\Support\EditorConfiguration\EditorConfiguration;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfiguration;
use Spatie\Navigation\Helpers\ActiveUrlChecker;

class MailcoachUiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('mailcoach-ui::app.layouts.partials.health', HealthViewComposer::class);
        View::composer('mailcoach-ui::app.layouts.partials.health-tiles', HealthViewComposer::class);

        $this
            ->configureModels()
            ->bootTranslations()
            ->bootConfig()
            ->bootPublishables()
            ->bootAuthorization()
            ->bootFlash()
            ->bootRoutes()
            ->bootCommands()
            ->bootViews();
    }

    protected function configureModels(): self
    {
        $key = config('mailcoach-ui.mailer_encryption_key');

        $cipher = config('app.cipher');

        Mailer::encryptUsing(new Encrypter($key, $cipher));

        return $this;
    }

    protected function bootConfig(): self
    {
        try {
            Mailer::registerAllConfigValues();
        } catch (QueryException) {
            // Do nothing as table probably doesn't exist
        }

        app(AppConfiguration::class)->registerConfigValues();
        app(MailConfiguration::class)->registerConfigValues();
        app(EditorConfiguration::class)->registerConfigValues();

        return $this;
    }

    protected function bootTranslations(): self
    {
        $langPath = 'vendor/spatie/mailcoach-ui';

        $langPath = (function_exists('lang_path'))
            ? lang_path($langPath)
            : resource_path('lang/' . $langPath);

        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang/');

        $this->publishes([
            __DIR__ . '/../resources/lang' => $langPath,
        ], "mailcoach-ui-translations");

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

            Route::prefix($url)
                ->middleware(array_merge(config('mailcoach-ui.middleware'), config('mailcoach.middleware.web')))
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

        Livewire::component('mailcoach::mailers', Mailers::class);
        Livewire::component('mailcoach::create-mailer', CreateMailerComponent::class);
        Livewire::component('mailcoach::create-user', CreateUserComponent::class);
        Livewire::component('mailcoach::general-settings', GeneralSettings::class);
        Livewire::component('mailcoach-ui::send-test', SendTest::class);

        SesSetupWizardComponent::registerLivewireComponents();
        SendGridSetupWizardComponent::registerLivewireComponents();
        SmtpSetupWizardComponent::registerLivewireComponents();


        Livewire::component('mailcoach-ui::editor-settings', EditorSettings::class);

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
        $this->app->scoped(SettingsNavigation::class, function () {
            return new SettingsNavigation(app(ActiveUrlChecker::class));
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/mailcoach-ui.php', 'mailcoach-ui');
    }
}
