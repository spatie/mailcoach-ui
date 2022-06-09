<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Mailers;

use Spatie\MailcoachUi\Http\App\Queries\MailersQuery;
use Spatie\MailcoachUi\Models\Mailer;

class MailersIndexController
{
    public function __invoke(MailersQuery $mailersQuery)
    {
        return view('mailcoach-ui::app.configuration.mailers.index', [
            'mailers' => $mailersQuery->paginate(),
            'totalMailersCount' => Mailer::count(),
        ]);
    }
}
