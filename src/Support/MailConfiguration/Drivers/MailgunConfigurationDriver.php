<?php

namespace Spatie\MailcoachUi\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class MailgunConfigurationDriver extends MailConfigurationDriver
{
    public function name(): string
    {
        return 'mailgun';
    }

    public function validationRules(): array
    {
        return [
            'default_from_mail' => 'required',
            'timespan_in_seconds' => 'required|numeric|gte:1',
            'mails_per_timespan' => 'required|numeric|gte:1',
            'mailgun_domain' => 'required',
            'mailgun_secret' => 'required',
            'mailgun_endpoint' => 'required',
            'mailgun_signing_secret' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $this
            ->setDefaultFromEmail($config, $values['default_from_mail'] ?? '')
            ->throttleNumberOfMailsPerSecond(
                $config,
                $values['mailgun_mails_per_second'] ?? 5,
                $values['timespan_in_seconds'] ?? 1,
            );

        $config->set('mail.mailers.mailcoach.transport', $this->name());
        $config->set('services.mailgun', [
            'domain' => $values['mailgun_domain'],
            'secret' => $values['mailgun_secret'],
            'endpoint' => $values['mailgun_endpoint'],
        ]);
        $config->set('mailcoach.mailgun_feedback', [
            'signing_secret' => $values['mailgun_signing_secret'],
        ]);
    }
}
