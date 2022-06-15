<?php

use Illuminate\Support\Facades\Route;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Account\PasswordController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Account\TokensController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Mailers\EditMailerController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\DestroyUserController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\UpdateUserController;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\UsersIndexController;
use Spatie\MailcoachUi\Http\App\Middleware\BootstrapSettingsNavigation;
use Spatie\MailcoachUi\Http\Auth\Controllers\LogoutController;
use Spatie\MailcoachUi\Http\Livewire\EditorSettings;
use Spatie\MailcoachUi\Http\Livewire\GeneralSettings;
use Spatie\MailcoachUi\Http\Livewire\Mailers;
use Spatie\MailcoachUi\Http\Livewire\Password;
use Spatie\MailcoachUi\Http\Livewire\Profile;

Route::prefix('settings')
    ->middleware([BootstrapSettingsNavigation::class])
    ->group(function () {
    Route::get('general', GeneralSettings::class)->name('general-settings');

    Route::prefix('account')->group(function () {
        Route::get('details', Profile::class)->name('account');

        Route::get('password', Password::class)->name('password');

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
        Route::get('{mailer:uuid}', EditMailerController::class)->name('mailers.edit');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', UsersIndexController::class)->name('users');

        Route::prefix('{user}')->group(function () {
            Route::get('edit', [UpdateUserController::class, 'edit'])->name('users.edit');
            Route::put('edit', [UpdateUserController::class, 'update']);
            Route::delete('/', DestroyUserController::class)->name('users.delete');
        });
    });

    Route::get('editor', EditorSettings::class)->name('editor');
});

Route::post('logout', LogoutController::class)->name('logout');
