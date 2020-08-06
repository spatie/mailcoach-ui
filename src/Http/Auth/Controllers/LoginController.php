<?php

namespace Spatie\MailcoachUi\Http\Auth\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class LoginController
{
    use AuthenticatesUsers, AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $redirectTo = '/campaigns';

    public function showLoginForm()
    {
        return view('mailcoach-ui::auth.login');
    }

    public function authenticated(Request $request, $user)
    {
        flash()->success(__('You are now logged in!'));

        return redirect()->intended(route('mailcoach.campaigns'));
    }
}
