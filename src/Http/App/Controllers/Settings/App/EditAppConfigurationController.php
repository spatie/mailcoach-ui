<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\App;

use Illuminate\Support\Facades\Artisan;
use Spatie\MailcoachUi\Http\App\Requests\UpdateAppConfigurationRequest;
use Spatie\MailcoachUi\Support\AppConfiguration\AppConfiguration;
use Spatie\MailcoachUi\Support\ConfigCache;
use Spatie\MailcoachUi\Support\TimeZone;

class EditAppConfigurationController
{
    public function edit(AppConfiguration $appConfiguration)
    {
        $timeZones = TimeZone::all();

        return view('mailcoach-ui::app.settings.appConfiguration.edit', compact(
            'appConfiguration',
            'timeZones',
        ));
    }

    public function update(UpdateAppConfigurationRequest $request, AppConfiguration $appConfiguration)
    {
        $appConfiguration->put($request->validated());

        ConfigCache::clear();

        dispatch(function () {
            Artisan::call('horizon:terminate');
        });

        flash()->success(__('The app configuration was saved.'));

        return back();
    }
}
