<?php

namespace Spatie\MailcoachUi\Support\AppConfiguration;

use Illuminate\Config\Repository;
use Spatie\MailcoachUi\Support\Concerns\UsesSettings;
use Spatie\MailcoachUi\Support\ConfigCache;

class AppConfiguration
{
    use UsesSettings;

    public function __construct(protected Repository $config)
    {
    }

    public function registerConfigValues(): void
    {
        config()->set('app.name', $this->get('name', config('app.name')));
        config()->set('app.timezone', $this->get('timezone', config('app.timezone')));
        config()->set('app.url', $this->get('url', config('app.url')));
        config()->set('filesystems.disks.public.url', $this->get('url', config('app.url')) . '/storage');
        config()->set('mail.from.address', $this->get('from_address', config('mail.from_address')));

        ConfigCache::clear();
    }

    public function getKeyName(): string
    {
        return 'appConfiguration';
    }
}
