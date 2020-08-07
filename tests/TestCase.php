<?php

namespace Spatie\MailcoachUi\Tests;

use CreateMailcoachTables;
use CreateMailcoachUiTables;
use CreateMediaTable;
use CreateUsersTable;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\SanctumServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Feed\FeedServiceProvider;
use Spatie\Mailcoach\MailcoachServiceProvider;
use Spatie\MailcoachMailgunFeedback\MailcoachMailgunFeedbackServiceProvider;
use Spatie\MailcoachPostmarkFeedback\MailcoachPostmarkFeedbackServiceProvider;
use Spatie\MailcoachSendgridFeedback\MailcoachSendgridFeedbackServiceProvider;
use Spatie\MailcoachSesFeedback\MailcoachSesFeedbackServiceProvider;
use Spatie\MailcoachUi\MailcoachUiServiceProvider;
use Spatie\MailcoachUi\Models\User;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;
use Spatie\QueryBuilder\QueryBuilderServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/database/factories');

        Route::mailcoachUi();

        config()->set('auth.providers.users.model', User::class);

        $this->app['router']->getRoutes()->refreshNameLookups();

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

        include_once __DIR__.'/../database/migrations/create_mailcoach_ui_tables.php.stub';
        (new CreateMailcoachUiTables())->up();
    }

    public function authenticate()
    {
        $user = factory(User::class)->create();

        $user->createToken('test');

        $this->actingAs($user);
    }
}
