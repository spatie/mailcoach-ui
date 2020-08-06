<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\MailConfiguration;

use Illuminate\Support\Facades\Artisan;
use Spatie\MailcoachUi\Http\App\Requests\UpdateMailConfigurationRequest;
use Spatie\MailcoachUi\Support\ConfigCache;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfiguration;

class EditMailConfigurationController
{
    public function edit(MailConfiguration $mailConfiguration)
    {
        return view('mailcoach-ui::app.settings.mailConfiguration.edit', compact('mailConfiguration'));
    }

    public function update(UpdateMailConfigurationRequest $request, MailConfiguration $mailConfiguration)
    {
        $mailConfiguration->put($request->validated());

        ConfigCache::clear();

        dispatch(function () {
            Artisan::call('horizon:terminate');
        });

        flash()->success(__('The mail configuration was saved.'));

        return back();
    }
}
