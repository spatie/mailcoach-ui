<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Users;

use Spatie\MailcoachUi\Http\App\Queries\UsersQuery;
use Spatie\MailcoachUi\Models\User;

class UsersIndexController
{
    public function __invoke(UsersQuery $usersQuery)
    {
        return view('mailcoach-ui::app.configuration.users.index', [
            'users' => $usersQuery->paginate(),
            'totalUsersCount' => User::count(),
        ]);
    }
}
