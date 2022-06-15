<?php

use Illuminate\Support\Facades\Route;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Account\AccountController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Account\PasswordController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Account\TokensController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\App\EditAppConfigurationController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\MailConfiguration\EditMailConfigurationController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\MailConfiguration\SendTestMailController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\MailConfiguration\Wizards\SesMailConfigurationController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Mailers\DestroyMailerController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Mailers\EditMailerController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\TransactionalMailConfiguration\DeleteTransactionalMailConfiguration;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\TransactionalMailConfiguration\EditTransactionalMailConfigurationController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\TransactionalMailConfiguration\SendTestTransactionalMailController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\CreateUserController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\DestroyUserController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\UpdateUserController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\UsersIndexController;
use Spatie\MailcoachUi\Http\App\Middleware\BootstrapSettingsNavigation;
use Spatie\MailcoachUi\Http\Auth\Controllers\LogoutController;
use Spatie\MailcoachUi\Http\Livewire\EditorSettings;
use \Spatie\MailcoachUi\Http\App\Controllers\Settings\Mailers\MailersIndexController;
use Spatie\MailcoachUi\Http\Livewire\Mailers;

Route::prefix('settings')
    ->middleware(BootstrapSettingsNavigation::class)
    ->group(function () {
    Route::get('app-configuration', [EditAppConfigurationController::class, 'edit'])->name('appConfiguration');
    Route::put('app-configuration', [EditAppConfigurationController::class, 'update']);

    Route::prefix('account')->group(function () {
        Route::get('details', [AccountController::class, 'index'])->name('account');
        Route::put('details', [AccountController::class, 'update']);

        Route::get('password', [PasswordController::class, 'index'])->name('password');
        Route::put('password', [PasswordController::class, 'update']);

        Route::prefix('tokens')->group(function () {
            Route::get('/', [TokensController::class, 'index'])->name('tokens');
            Route::post('/', [TokensController::class, 'store'])->name('tokens.create');
            Route::delete("{personalAccessToken}", [TokensController::class, 'destroy'])
                ->name('tokens.delete')
                ->middleware('can:administer,personalAccessToken');
        });
    });

    Route::prefix('mailers')->group(function() {
        Route::get('/', Mailers::class)->name('mailers');
        Route::get('{mailer}', EditMailerController::class)->name('mailers.edit');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', UsersIndexController::class)->name('users');

        Route::prefix('{user}')->group(function () {
            Route::get('edit', [UpdateUserController::class, 'edit'])->name('users.edit');
            Route::put('edit', [UpdateUserController::class, 'update']);
            Route::delete('/', DestroyUserController::class)->name('users.delete');
        });
    });

    Route::post('send-test-mail', [SendTestMailController::class, 'sendTestEmail'])->name('sendTestMail');

    Route::get('editor', EditorSettings::class)->name('editor');
});

Route::post('logout', LogoutController::class)->name('logout');
