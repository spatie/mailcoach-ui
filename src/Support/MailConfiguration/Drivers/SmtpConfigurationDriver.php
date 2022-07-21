<?php

namespace Spatie\MailcoachUi\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class SmtpConfigurationDriver extends MailConfigurationDriver
{
    public function name(): string
    {
        return 'smtp';
    }

    public function validationRules(): array
    {
        return [
            'default_from_mail' => 'required|email',
            'timespan_in_seconds' => 'required|numeric|gte:1',
            'mails_per_timespan' => 'required|numeric|gte:1',
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'smtp_username' => 'required',
            'smtp_password' => 'required',
            'smtp_encryption' => 'nullable',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $this
            ->setDefaultFromEmail($config, $values['default_from_mail'] ?? '')
            ->throttleNumberOfMailsPerSecond(
                $config,
                $values['mails_per_timespan'] ?? $values['smtp_mails_per_second'] ?? 5,
                $values['timespan_in_seconds'] ?? 1,
            );

        $config->set('mail.mailers.mailcoach.transport', $this->name());
        $config->set('mail.mailers.mailcoach.host', $values['smtp_host']);
        $config->set('mail.mailers.mailcoach.port', $values['smtp_port']);
        $config->set('mail.mailers.mailcoach.username', $values['smtp_username']);
        $config->set('mail.mailers.mailcoach.password', $values['smtp_password']);
        $config->set('mail.mailers.mailcoach.encryption', $values['smtp_encryption'] ?? null);
    }
}
