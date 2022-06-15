<?php

namespace Spatie\MailcoachUi\Http\Livewire;

use Illuminate\Http\Request;
use Spatie\Mailcoach\Http\App\Livewire\DataTable;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachUi\Http\App\Queries\MailersQuery;
use Spatie\MailcoachUi\Models\Mailer;

class Mailers extends DataTable
{
    use LivewireFlash;

    public function getTitle(): string
    {
        return __('Mailers');
    }

    public function getView(): string
    {
        return 'mailcoach-ui::app.configuration.mailers.index';
    }

    public function getLayout(): string
    {
        return 'mailcoach-ui::app.layouts.settings';
    }

    public function getLayoutData(): array
    {
        return [
            'title' => __('Mailers'),
        ];
    }

    public function deleteMailer(int $id)
    {
        $mailer = Mailer::find($id);

        $mailer->delete();

        $this->flash(__('Mailer :mailer successfully deleted', ['mailer' => $mailer->name]));
    }

    public function getData(Request $request): array
    {
        return [
            'mailers' => resolve(MailersQuery::class)->paginate(),
            'totalMailersCount' => Mailer::count(),
        ];
    }
}
