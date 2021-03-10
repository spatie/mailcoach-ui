<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\Account;

use Spatie\MailcoachUi\Http\App\Requests\StoreTokenRequest;
use Spatie\MailcoachUi\Models\PersonalAccessToken;

class TokensController
{
    public function index()
    {
        return view('mailcoach-ui::app.account.tokens', [
            'tokens' => auth()->user()->tokens,
        ]);
    }

    public function store(StoreTokenRequest $request)
    {
        /** @var \Laravel\Sanctum\NewAccessToken $token */
        $token = auth()->user()->createToken($request->name);

        session()->flash('newToken', $token->plainTextToken);

        flash()->success(__('The token has been created.'));

        return redirect()->route('tokens');
    }

    public function destroy(PersonalAccessToken $personalAccessToken)
    {
        $personalAccessToken->delete();

        flash()->success(__('The token has been deleted.'));

        return redirect()->route('tokens');
    }
}
