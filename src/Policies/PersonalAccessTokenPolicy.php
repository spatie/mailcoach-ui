<?php

namespace Spatie\MailcoachUi\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\MailcoachUi\Models\PersonalAccessToken;
use Spatie\MailcoachUi\Models\User;

class PersonalAccessTokenPolicy
{
    use HandlesAuthorization;

    public function administer(User $user, PersonalAccessToken  $personalAccessToken)
    {
        return $user->id === $personalAccessToken->user()->id;
    }
}
