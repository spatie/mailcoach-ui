<?php

namespace Spatie\MailcoachUi\Support\TransactionalMailConfiguration;

use Illuminate\Config\Repository;
use Spatie\MailcoachUi\Support\Concerns\UsesSettings;
use Spatie\MailcoachUi\Support\ConfigCache;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers\TransactionalMailConfigurationDriver;

class TransactionalMailConfiguration
{
    use UsesSettings;

    public function __construct(
        protected Repository $config,
        protected TransactionalMailConfigurationDriverRepository $transactionalMailConfigurationDriverRepository
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

    protected function getDriver(): ?TransactionalMailConfigurationDriver
    {
        return $this
            ->transactionalMailConfigurationDriverRepository
            ->getForDriver($this->get('driver', ''));
    }

    public function getKeyName(): string
    {
        return 'transactionalMailConfiguration';
    }
}
