<?php

namespace Spatie\MailcoachUi\Http\Auth\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Spatie\Mailcoach\Http\App\Controllers\Campaigns\CampaignsIndexController;

class ResetPasswordController
{
    use ResetsPasswords;
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function showResetForm(Request $request)
    {
        return view('mailcoach-ui::auth.passwords.reset', [
            'token' => $request->get('token'),
            'email' => $request->get('email'),
        ]);
    }

    protected function sendResetResponse(Request $request, $response)
    {
        flash()->success(trans($response));

        return action(CampaignsIndexController::class);
    }
}
