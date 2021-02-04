<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings;

use Illuminate\Support\Facades\Artisan;
use Spatie\MailcoachUi\Http\App\Requests\UpdateEditorRequest;
use Spatie\MailcoachUi\Support\ConfigCache;
use Spatie\MailcoachUi\Support\EditorConfiguration\EditorConfiguration;

class EditorController
{
    public function edit(EditorConfiguration $editorConfiguration)
    {
        return view('mailcoach-ui::app.configuration.editor.edit', compact('editorConfiguration'));
    }

    public function update(UpdateEditorRequest $request, EditorConfiguration $editorConfiguration)
    {
        $editorConfiguration->put($request->validated());

        flash()->success(__('The editor has been updated.'));

        ConfigCache::clear();

        Artisan::call('view:clear');

        return back();
    }
}
