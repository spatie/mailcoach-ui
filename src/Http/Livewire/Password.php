<?php

namespace Spatie\MailcoachUi\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;

class Password extends Component
{
    use LivewireFlash;

    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public array $rules = [
        'current_password' => ['required', 'current_password'],
        'password' => ['min:6', 'confirmed'],
    ];

    public function save()
    {
        $this->validate();

        Auth::user()->update(['password' => Hash::make($this->password)]);

        $this->flash(__('Your password has been updated.'));
    }

    public function render()
    {
        return view('mailcoach-ui::app.account.password')
            ->layout('mailcoach-ui::app.layouts.settings', ['title' => __('Password')]);
    }
}
