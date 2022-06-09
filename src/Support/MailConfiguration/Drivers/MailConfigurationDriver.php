<?php

namespace Spatie\MailcoachUi\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;
use Spatie\MailcoachUi\Support\MailConfiguration\MailConfiguration;

abstract class MailConfigurationDriver
{
    public function __construct(protected MailConfiguration $mailConfiguration)
    {
    }

    abstract public function name(): string;

    abstract public function isConfigured(): array;

    abstract public function registerConfigValues(Repository $config, array $values);

    protected function throttleNumberOfMailsPerSecond(Repository $config, int $mailsPerSecond, int $timespanInSeconds): self
    {
        $config->set('mailcoach.campaigns.throttling.allowed_number_of_jobs_in_timespan', $mailsPerSecond);
        $config->set('mailcoach.campaigns.throttling.timespan_in_seconds', $timespanInSeconds);
        $config->set('mailcoach.automation.throttling.allowed_number_of_jobs_in_timespan', $mailsPerSecond);
        $config->set('mailcoach.automation.throttling.timespan_in_seconds', $timespanInSeconds);

        return $this;
    }

    protected function setDefaultFromEmail(Repository $config, string $defaultFromEmail): self
    {
        $config->set('mail.from.address', $defaultFromEmail);

        return $this;
    }
}
