<?php

namespace Spatie\MailcoachUi\Http\App\ViewComposers;

use Composer\InstalledVersions;
use Illuminate\View\View;
use Spatie\Mailcoach\Domain\Shared\Support\HorizonStatus;

class HealthViewComposer
{
    protected HorizonStatus $horizonStatus;

    public function __construct(HorizonStatus $horizonStatus)
    {
        $this->horizonStatus = $horizonStatus;
    }

    public function compose(View $view)
    {
        $view->with([
            'usesVapor' => InstalledVersions::isInstalled("laravel/vapor-core"),
            'horizonActive' => $this->horizonStatus->is(HorizonStatus::STATUS_ACTIVE),
            'queueConfig' => config('queue.connections.mailcoach-redis') && ! empty(config('queue.connections.mailcoach-redis')),
        ]);
    }
}
