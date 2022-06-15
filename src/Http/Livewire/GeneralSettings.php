<?php

namespace Spatie\MailcoachUi\Http\Livewire;

use Composer\InstalledVersions;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Mailcoach\Http\App\Livewire\LivewireFlash;
use Spatie\MailcoachUi\Support\AppConfiguration\AppConfiguration;
use Spatie\MailcoachUi\Support\ConfigCache;
use Spatie\MailcoachUi\Support\TimeZone;

class GeneralSettings extends Component
{
    use LivewireFlash;

    public string $name = '';

    public string $timezone = '';

    public string $url = '';

    public string $from_address = '';

    public function rules()
    {
        return [
            'name' => ['required'],
            'timezone' => ['required', Rule::in(TimeZone::all())],
            'url' => ['required', 'url'],
            'from_address' => ['required', 'email:rfc,dns'],
        ];
    }

    public function mount(AppConfiguration $appConfiguration)
    {
        $this->name = $appConfiguration->name ?? config('app.name');
        $this->timezone = $appConfiguration->timezone ?? config('app.timezone');
        $this->url = $appConfiguration->url ?? config('app.url');
        $this->from_address = $appConfiguration->from_address ?? config('mail.from.address') ?? '';
    }

    public function save()
    {
        resolve(AppConfiguration::class)->put($this->validate());

        ConfigCache::clear();

        if (InstalledVersions::isInstalled("laravel/horizon")) {
            dispatch(function () {
                if (app()->runningInConsole()) {
                    Artisan::call('horizon:terminate');
                }
            });
        }

        $this->flash(__('The app configuration was saved.'));
    }

    public function render()
    {
        $timeZones = TimeZone::all();

        return view('mailcoach-ui::app.configuration.app.edit', compact('timeZones'))
            ->layout('mailcoach-ui::app.layouts.settings');
    }
}
