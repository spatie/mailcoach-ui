<?php

namespace Spatie\MailcoachUi\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class PostalConfigurationDriver extends MailConfigurationDriver
{
    public function name(): string
    {
        return 'postal';
    }

    public function validationRules(): array
    {
        return [
            'default_from_mail' => 'required',
            'timespan_in_seconds' => 'required|numeric|gte:1',
            'mails_per_timespan' => 'required|numeric|gte:1',
            'postal_host' => 'required',
            'postal_port' => 'required',
            'postal_token' => 'required',
            'postal_secret' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $this
            ->setDefaultFromEmail($config, $values['default_from_mail'] ?? '')
            ->throttleNumberOfMailsPerSecond(
                $config,
                $values['mails_per_timespan'] ?? $values['postal_mails_per_second'] ?? 5,
                $values['timespan_in_seconds'] ?? 1,
            );

        $config->set('mail.mailers.mailcoach.transport', 'smtp');
        $config->set('mail.mailers.mailcoach.host', $values['postal_host']);
        $config->set('mail.mailers.mailcoach.port', $values['postal_port']);
        $config->set('mail.mailers.mailcoach.username', 'aickey');
        $config->set('mail.mailers.mailcoach.password', $values['postal_token']);

        $config->set('mailcoach.postal_feedback', [
            'signing_secret' => $values['postal_secret'],
        ]);
    }
}
