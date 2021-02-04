<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Account;

use Spatie\MailcoachUi\Http\App\Requests\UpdateAccountRequest;

class AccountController
{
    public function index()
    {
        return view('mailcoach-ui::app.account.index', [
            'user' => auth()->user(),
        ]);
    }

    public function update(UpdateAccountRequest $request)
    {
        auth()->user()->update([
            'email' => $request->email,
            'name' => $request->name,
        ]);

        flash()->success(__('Your account has been updated.'));

        return redirect()->action([static::class, 'index']);
    }
}
