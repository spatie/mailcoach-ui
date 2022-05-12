<?php

namespace Spatie\MailcoachUi\Support\MailConfiguration;

use Illuminate\Config\Repository;
use Spatie\MailcoachUi\Support\Concerns\UsesSettings;
use Spatie\MailcoachUi\Support\ConfigCache;
use Spatie\MailcoachUi\Support\MailConfiguration\Drivers\MailConfigurationDriver;

class MailConfiguration
{
    use UsesSettings;

    public function __construct(
        protected Repository $config,
        protected MailConfigurationDriverRepository $mailConfigurationDriverRepository
    ) {
    }

    public function registerConfigValues(): void
    {
        if (! $this->getDriver()) {
            return;
        }

        $this->getDriver()->registerConfigValues(
            $this->config,
            $this->all()
        );

        ConfigCache::clear();
    }

    public function isValid(): bool
    {
        return $this->getDriver() !== null;
    }

    protected function getDriver(): ?MailConfigurationDriver
    {
        return $this->mailConfigurationDriverRepository->getForDriver($this->get('driver', ''));
    }

    public function getKeyName(): string
    {
        return 'mailConfiguration';
    }
}
