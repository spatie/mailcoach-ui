<?php

namespace Spatie\MailcoachUi\Http\App\Middleware;

use Illuminate\Http\Request;
use Spatie\Mailcoach\Domain\Shared\Traits\UsesMailcoachModels;
use Spatie\MailcoachUi\SettingsNavigation;
use Spatie\Navigation\Section;

class BootstrapSettingsNavigation
{
    use UsesMailcoachModels;

    public function handle(Request $request, $next)
    {
        app(SettingsNavigation::class)
            ->add(__('Profile'), route('account'))
            ->add(__('Password'), route('password'))
            ->add(__('Users'), route('users'))
            ->add(__('Configuration'), route('appConfiguration'), function (Section $section) {
                $section
                    ->add(__('App'), route('appConfiguration'))
                    ->add(__('Mailers'), route('mailers'))
                    ->add(__('Editor'), route('editor'))
                    ->add(__('API Tokens'), route('tokens'));
            });

        return $next($request);
    }
}
