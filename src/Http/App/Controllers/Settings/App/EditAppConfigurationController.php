<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\App;

use Spatie\MailcoachUi\Http\App\Requests\UpdateAppConfigurationRequest;
use Spatie\MailcoachUi\Support\AppConfiguration\AppConfiguration;
use Spatie\MailcoachUi\Support\ConfigCache;
use Illuminate\Support\Facades\Artisan;

class EditAppConfigurationController
{
    public function edit(AppConfiguration $appConfiguration)
    {
        return view('app.settings.appConfiguration.edit', compact('appConfiguration'));
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
