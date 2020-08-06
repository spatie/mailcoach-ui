<?php

namespace Spatie\MailcoachUi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\MailcoachUi\MailcoachUi
 */
class MailcoachUiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mailcoach-ui';
    }
}
