<?php

namespace Spatie\MailcoachUi\Http\Livewire;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\MailcoachUi\Http\App\Controllers\Settings\Users\UsersIndexController;
use Spatie\MailcoachUi\Models\User;

class CreateUser extends Component
{
    public string $email = '';
    public string $name = '';

    public function saveUser()
    {
        $validated = $this->validate([
            'email' => ['required', 'email:rfc', Rule::unique('users', 'email')],
            'name' => 'required|string',
        ]);

        $user = User::create(array_merge($validated, ['password' => Str::random(64)]));

        $expiresAt = now()->addDay();

        try {
            $user->sendWelcomeNotification($expiresAt);

            flash()->success(__('The user has been created. A mail with login instructions has been sent to :email', ['email' => $user->email]));
        } catch (\Throwable $e) {
            report($e);
            flash()->warning(__('The user has been created. A mail with setup instructions could not be sent.'));
        }

        return redirect()->action(UsersIndexController::class);
    }

    public function render()
    {
        return view('mailcoach-ui::app.configuration.users.partials.create');
    }
}
