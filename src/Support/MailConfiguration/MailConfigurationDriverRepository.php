<?php

namespace Spatie\MailcoachUi\Support\MailConfiguration;

use Spatie\MailcoachUi\Support\MailConfiguration\Drivers\MailConfigurationDriver;
use Spatie\MailcoachUi\Support\MailConfiguration\Drivers\MailgunConfigurationDriver;
use Spatie\MailcoachUi\Support\MailConfiguration\Drivers\PostalConfigurationDriver;
use Spatie\MailcoachUi\Support\MailConfiguration\Drivers\PostmarkConfigurationDriver;
use Spatie\MailcoachUi\Support\MailConfiguration\Drivers\SendgridConfigurationDriver;
use Spatie\MailcoachUi\Support\MailConfiguration\Drivers\SesConfigurationDriver;
use Spatie\MailcoachUi\Support\MailConfiguration\Drivers\SmtpConfigurationDriver;

class MailConfigurationDriverRepository
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

    public function getForDriver(string $driverName): ?MailConfigurationDriver
    {
        return collect($this->drivers)
            ->map(fn (string $driverClass) => app($driverClass))
            ->first(fn (MailConfigurationDriver $driver) => $driver->name() === $driverName);
    }
}
