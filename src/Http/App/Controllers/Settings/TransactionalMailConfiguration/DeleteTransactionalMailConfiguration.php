<?php

namespace Spatie\MailcoachUi\Http\App\Controllers\Settings\TransactionalMailConfiguration;

use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\TransactionalMailConfiguration;

class DeleteTransactionalMailConfiguration
{
    public function __invoke(TransactionalMailConfiguration $mailConfiguration)
    {
        flash()->success(__('The transactional mail configuration has been deleted'));

        $mailConfiguration->empty();

        return back();
    }
}
