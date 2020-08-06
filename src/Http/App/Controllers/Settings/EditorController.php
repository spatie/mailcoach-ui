<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings;

use Spatie\MailcoachUi\Http\App\Requests\UpdateEditorRequest;
use Spatie\MailcoachUi\Support\ConfigCache;
use Spatie\MailcoachUi\Support\EditorConfiguration\EditorConfiguration;
use Illuminate\Support\Facades\Artisan;

class EditorController
{
    public function edit(EditorConfiguration $editorConfiguration)
    {
        return view('app.settings.editor.edit', compact('editorConfiguration'));
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
