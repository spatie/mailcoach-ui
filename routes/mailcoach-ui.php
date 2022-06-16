<?php

use Illuminate\Support\Facades\Route;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Account\TokensController;
use Spatie\MailcoachUi\Http\App\Middleware\BootstrapSettingsNavigation;
use Spatie\MailcoachUi\Http\Auth\Controllers\LogoutController;
use Spatie\MailcoachUi\Http\Livewire\EditMailer;
use Spatie\MailcoachUi\Http\Livewire\EditorSettings;
use Spatie\MailcoachUi\Http\Livewire\EditUser;
use Spatie\MailcoachUi\Http\Livewire\GeneralSettings;
use Spatie\MailcoachUi\Http\Livewire\Mailers;
use Spatie\MailcoachUi\Http\Livewire\Password;
use Spatie\MailcoachUi\Http\Livewire\Profile;
use Spatie\MailcoachUi\Http\Livewire\Tokens;
use Spatie\MailcoachUi\Http\Livewire\Users;

Route::prefix('settings')
    ->middleware([BootstrapSettingsNavigation::class])
    ->group(function () {
    Route::get('general', GeneralSettings::class)->name('general-settings');

    Route::prefix('account')->group(function () {
        Route::get('details', Profile::class)->name('account');

        Route::get('password', Password::class)->name('password');

        Route::prefix('tokens')->group(function () {
            Route::get('/', Tokens::class)->name('tokens');
            //Route::get('/', [TokensController::class, 'index'])->name('tokens');
            Route::post('/', [TokensController::class, 'store'])->name('tokens.create');
            Route::delete("{personalAccessToken}", [TokensController::class, 'destroy'])
                ->name('tokens.delete')
                ->middleware('can:administer,personalAccessToken');
        });
    });

    Route::prefix('mailers')->group(function() {
        Route::get('/', Mailers::class)->name('mailers');
        Route::get('{mailer:uuid}', EditMailer::class)->name('mailers.edit');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', Users::class)->name('users');
        Route::get('{user}', EditUser::class)->name('users.edit');
    });

    Route::get('editor', EditorSettings::class)->name('editor');
});

Route::post('logout', LogoutController::class)->name('logout');
