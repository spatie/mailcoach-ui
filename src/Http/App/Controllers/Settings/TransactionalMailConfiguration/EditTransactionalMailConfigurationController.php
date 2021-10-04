<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\TransactionalMailConfiguration;

use Composer\InstalledVersions;
use Illuminate\Support\Facades\Artisan;
use Spatie\MailcoachUi\Http\App\Requests\UpdateTransactionalMailConfigurationRequest;
use Spatie\MailcoachUi\Support\ConfigCache;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\TransactionalMailConfiguration;

class EditTransactionalMailConfigurationController
{
    public function edit(TransactionalMailConfiguration $mailConfiguration)
    {
        return view('mailcoach-ui::app.drivers.transactionalMails.edit', compact('mailConfiguration'));
    }

    public function update(
        UpdateTransactionalMailConfigurationRequest $request,
        TransactionalMailConfiguration $mailConfiguration
    ) {
        $mailConfiguration->put($request->validated());

        ConfigCache::clear();

        if (InstalledVersions::isInstalled("laravel/horizon")) {
            dispatch(function () {
                Artisan::call('horizon:terminate');
            });
        }

        flash()->success(__('The transactional mail configuration was saved.'));

        return back();
    }
}
