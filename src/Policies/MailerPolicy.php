<?php

namespace Spatie\MailcoachUi\Policies;

use Illuminate\Contracts\Auth\Access\Authorizable;

class MailerPolicy
{
    public function __call($method, $args): bool
    {
        /** @var Authorizable $user */
        $user = array_shift($args);

        return $user->can('viewMailcoach');
    }
}
