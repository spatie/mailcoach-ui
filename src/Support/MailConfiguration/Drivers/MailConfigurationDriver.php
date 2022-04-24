<?php

namespace Spatie\MailcoachUi\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

abstract class MailConfigurationDriver
{
    abstract public function name(): string;

    abstract public function validationRules(): array;

    abstract public function registerConfigValues(Repository $config, array $values);

    public function fields()
    {
        return array_keys($this->validationRules());
    }

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
