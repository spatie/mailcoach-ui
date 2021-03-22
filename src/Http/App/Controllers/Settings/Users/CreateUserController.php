<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Users;

use Exception;
use Illuminate\Support\Str;
use Spatie\MailcoachUi\Http\App\Requests\UpdateUserRequest;
use Spatie\MailcoachUi\Models\User;

class CreateUserController
{
    public function __invoke(UpdateUserRequest $request)
    {
        $validatedProperties = $request->validated();

        $user = User::create(array_merge($validatedProperties, ['password' => Str::random(64)]));

        $expiresAt = now()->addDay();

        try {
            $user->sendWelcomeNotification($expiresAt);

            flash()->success(__('The user has been created. A mail with login instructions has been sent to :email', ['email' => $user->email]));
        } catch (Exception $exception) {
            report($exception);
            flash()->warning(__('The user has been created. A mail with setup instructions could not be sent.'));
        }

        return redirect()->action(UsersIndexController::class);
    }
}
