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
            'postal_mails_per_second' => 'required|numeric|between:1,100',
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
            ->throttleNumberOfMailsPerSecond($config, $values['postal_mails_per_second'] ?? 5);

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
