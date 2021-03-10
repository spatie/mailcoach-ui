<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Account;

use Spatie\MailcoachUi\Http\App\Requests\UpdatePasswordRequest;

class PasswordController
{
    public function index()
    {
        return view('mailcoach-ui::app.account.password');
    }

    public function update(UpdatePasswordRequest $request)
    {
        auth()->user()->update(['password' => bcrypt($request->password)]);

        flash()->success(__('Your password has been updated.'));

        return redirect()->action([static::class, 'index']);
    }
}
