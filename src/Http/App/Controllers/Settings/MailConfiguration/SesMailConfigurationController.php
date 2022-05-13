<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\MailConfiguration;

class SesMailConfigurationController
{
    public function __invoke()
    {
        return view('mailcoach-ui::app.drivers.campaigns.ses');

    }
}
