<?php

use Spatie\MailcoachUi\Http\App\Controllers\Settings\Account\AccountController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Account\PasswordController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Account\TokensController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\App\EditAppConfigurationController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\EditorController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\MailConfiguration\EditMailConfigurationController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\MailConfiguration\SendTestMailController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\TransactionalMailConfiguration\DeleteTransactionalMailConfiguration;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\TransactionalMailConfiguration\EditTransactionalMailConfigurationController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\TransactionalMailConfiguration\SendTestTransactionalMailController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\CreateUserController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\DestroyUserController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\UpdateUserController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\UsersIndexController;
use Spatie\MailcoachUi\Http\Auth\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::prefix('settings')->group(function () {
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

    Route::prefix('users')->group(function () {
        Route::get('/', UsersIndexController::class)->name('users');
        Route::post('create', CreateUserController::class)->name('users.create');

        Route::prefix('{user}')->group(function () {
            Route::get('edit', [UpdateUserController::class, 'edit'])->name('users.edit');
            Route::put('edit', [UpdateUserController::class, 'update']);

            Route::delete('/', DestroyUserController::class)->name('users.delete');
        });
    });

    Route::get('mail-configuration', [EditMailConfigurationController::class, 'edit'])->name('mailConfiguration');
    Route::put('mail-configuration', [EditMailConfigurationController::class, 'update']);
    Route::post('send-test-mail', [SendTestMailController::class, 'sendTestEmail'])->name('sendTestMail');

    Route::get('transactional-mail-configuration', [EditTransactionalMailConfigurationController::class, 'edit'])->name('transactionalMailConfiguration');
    Route::put('transactional-mail-configuration', [EditTransactionalMailConfigurationController::class, 'update']);
    Route::delete('transactional-mail-configuration', DeleteTransactionalMailConfiguration::class)->name('deleteTransactionalMailConfiguration');
    Route::post('send-transactional-test-mail', [SendTestTransactionalMailController::class, 'sendTransactionalTestEmail'])->name('sendTransactionalTestEmail');

    Route::get('editor', [EditorController::class, 'edit'])->name('editor');
    Route::post('editor', [EditorController::class, 'update']);
});

Route::post('logout', LogoutController::class)->name('logout');
