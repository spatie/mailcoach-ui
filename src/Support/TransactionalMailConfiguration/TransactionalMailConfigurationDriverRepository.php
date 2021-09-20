<?php

namespace Spatie\MailcoachUi\Support\TransactionalMailConfiguration;

use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers\MailgunConfigurationDriver;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers\PostalConfigurationDriver;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers\PostmarkConfigurationDriver;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers\SendgridConfigurationDriver;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers\SesConfigurationDriver;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers\SmtpConfigurationDriver;
use Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers\TransactionalMailConfigurationDriver;

class TransactionalMailConfigurationDriverRepository
{
    protected array $drivers = [
        'ses' => SesConfigurationDriver::class,
        'mailgun' => MailgunConfigurationDriver::class,
        'sendgrid' => SendgridConfigurationDriver::class,
        'postmark' => PostmarkConfigurationDriver::class,
        'postal' => PostalConfigurationDriver::class,
        'smtp' => SmtpConfigurationDriver::class,
    ];

    public function getSupportedDrivers(): array
    {
        return array_keys($this->drivers);
    }

    public function getForDriver(string $driverName): ?TransactionalMailConfigurationDriver
    {
        return collect($this->drivers)
            ->map(fn (string $driverClass) => app($driverClass))
            ->first(fn (TransactionalMailConfigurationDriver $driver) => $driver->name() === $driverName);
    }
}
