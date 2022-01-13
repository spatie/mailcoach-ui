<?php

namespace Spatie\MailcoachUi\Tests;

use CreateMailcoachTables;
use CreateMailcoachUiTables;
use CreateMediaTable;
use CreatePersonalAccessTokensTable;
use CreateUsersTable;
use IDCH\MailcoachPostalFeedback\MailcoachPostalFeedbackServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\SanctumServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Feed\FeedServiceProvider;
use Spatie\Mailcoach\MailcoachServiceProvider;
use Spatie\MailcoachEditor\MailcoachEditorServiceProvider;
use Spatie\MailcoachMailgunFeedback\MailcoachMailgunFeedbackServiceProvider;
use Spatie\MailcoachPostmarkFeedback\MailcoachPostmarkFeedbackServiceProvider;
use Spatie\MailcoachSendgridFeedback\MailcoachSendgridFeedbackServiceProvider;
use Spatie\MailcoachSesFeedback\MailcoachSesFeedbackServiceProvider;
use Spatie\MailcoachUi\MailcoachUiServiceProvider;
use Spatie\MailcoachUi\Models\User;
use Spatie\MailcoachUnlayer\MailcoachUnlayerServiceProvider;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;
use Spatie\QueryBuilder\QueryBuilderServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Route::mailcoachUi();

        config()->set('auth.providers.users.model', User::class);

        $this->app['router']->getRoutes()->refreshNameLookups();

        Factory::guessFactoryNamesUsing(
            function (string $modelName) {
                return 'Spatie\\MailcoachUi\\Tests\\Database\\Factories\\' . class_basename($modelName) . 'Factory';
            }
        );

        $this->withoutExceptionHandling();
    }

    protected function getPackageProviders($app)
    {
        return [
            SanctumServiceProvider::class,
            FeedServiceProvider::class,
            MediaLibraryServiceProvider::class,
            QueryBuilderServiceProvider::class,

            MailcoachServiceProvider::class,
            MailcoachUiServiceProvider::class,
            MailcoachSesFeedbackServiceProvider::class,
            MailcoachMailgunFeedbackServiceProvider::class,
            MailcoachSendgridFeedbackServiceProvider::class,
            MailcoachPostmarkFeedbackServiceProvider::class,
            MailcoachPostalFeedbackServiceProvider::class,
            MailcoachUnlayerServiceProvider::class,
            MailcoachEditorServiceProvider::class,

            LivewireServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        include_once __DIR__.'/database/migrations/create_users_table.php.stub';
        (new CreateUsersTable())->up();

        include_once __DIR__.'/../vendor/spatie/laravel-mailcoach/database/migrations/create_mailcoach_tables.php.stub';
        (new CreateMailcoachTables())->up();

        include_once __DIR__.'/../vendor/spatie/laravel-medialibrary/database/migrations/create_media_table.php.stub';
        (new CreateMediaTable())->up();

        include_once __DIR__.'/../vendor/laravel/sanctum/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php';
        (new CreatePersonalAccessTokensTable())->up();

        include_once __DIR__.'/../database/migrations/create_mailcoach_ui_tables.php.stub';
        (new CreateMailcoachUiTables())->up();
    }

    public function authenticate()
    {
        $user = User::factory()->create();

        $user->createToken('test');

        $this->actingAs($user);
    }
}
