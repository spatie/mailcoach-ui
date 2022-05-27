<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\MailConfiguration;

use Spatie\Mailcoach\MainNavigation;

class SesMailConfigurationController
{
    public function __invoke()
    {
        app(MainNavigation::class)->activeSection()->add('Ses setup wizard');

        return view('mailcoach-ui::app.drivers.campaigns.ses');
    }
}
