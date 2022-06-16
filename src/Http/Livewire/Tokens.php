<?php

namespace Spatie\MailcoachUi\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachUi\Models\PersonalAccessToken;

class Tokens extends Component
{
    use LivewireFlash;

    public string $name = '';

    public string $newToken = '';

    public array $rules = [
        'name' => 'required',
    ];

    public function save()
    {
        $this->validate();

        /** @var \Laravel\Sanctum\NewAccessToken $token */
        $token =Auth::user()->createToken($this->name);

        $this->newToken = $token->plainTextToken;

        $this->flash(__('The token has been created.'));

        $this->name = '';
    }

    public function delete(int $id)
    {
        $token = PersonalAccessToken::find($id);
        $token->delete();

        $this->flash(__('The token has been deleted.'));
    }

    public function render()
    {
        return view('mailcoach-ui::app.account.tokens', [
            'tokens' => Auth::user()->tokens,
        ])->layout('mailcoach-ui::app.layouts.settings', ['title' => __('Tokens')]);
    }
}
