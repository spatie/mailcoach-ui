<?php

namespace Spatie\MailcoachUi\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class PostmarkConfigurationDriver extends MailConfigurationDriver
{
    public function name(): string
    {
        return 'postmark';
    }

    public function validationRules(): array
    {
        return [
            'default_from_mail' => 'required',
            'timespan_in_seconds' => 'required|numeric|gte:1',
            'mails_per_timespan' => 'required|numeric|gte:1',
            'postmark_token' => 'required',
            'postmark_signing_secret' => 'required',
            'message_stream' => ['nullable', 'string'],
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $this
            ->setDefaultFromEmail($config, $values['default_from_mail'] ?? '')
            ->throttleNumberOfMailsPerSecond(
                $config,
                $values['mails_per_timespan'] ?? $values['postmark_mails_per_second'] ?? 5,
                $values['timespan_in_seconds'] ?? 1,
            );

        $config->set('mail.mailers.mailcoach.transport', $this->name());
        $config->set('services.postmark', [
            'token' => $values['postmark_token'],
        ]);
        $config->set('mailcoach.postmark_feedback', [
            'signing_secret' => $values['postmark_signing_secret'],
            'message_stream' => $values['message_stream'],
        ]);
    }
}
