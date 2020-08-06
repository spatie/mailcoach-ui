<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Users;

use Spatie\MailcoachUi\Models\User;

class DestroyUserController
{
    public function __invoke(User $user)
    {
        if ($user->id === auth()->user()->id) {
            flash()->error(__('You cannot delete yourself!'));

            return redirect()->action(UsersIndexController::class);
        }

        $user->delete();

        flash()->success(__('The user has been deleted.'));

        return redirect()->action(UsersIndexController::class);
    }
}
