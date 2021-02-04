<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Users;

use Spatie\MailcoachUi\Http\App\Requests\UpdateUserRequest;
use Spatie\MailcoachUi\Models\User;

class UpdateUserController
{
    public function edit(User $user)
    {
        return view('mailcoach-ui::app.configuration.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user, UpdateUserRequest $updateUserRequest)
    {
        $user->update($updateUserRequest->validated());

        flash()->success(__('The user has been updated.'));

        return redirect()->action(UsersIndexController::class);
    }
}
