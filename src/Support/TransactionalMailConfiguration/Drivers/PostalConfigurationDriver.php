<?php

namespace Spatie\MailcoachUi\Support\TransactionalMailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class PostalConfigurationDriver extends TransactionalMailConfigurationDriver
{
    public function name(): string
    {
        return 'postal';
    }

    public function validationRules(): array
    {
        return [
            'postal_host' => 'required',
            'postal_port' => 'required',
            'postal_token' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.mailers.mailcoach-transactional.transport', 'smtp');
        $config->set('mail.mailers.mailcoach-transactional.host', $values['postal_host']);
        $config->set('mail.mailers.mailcoach-transactional.port', $values['postal_port']);
        $config->set('mail.mailers.mailcoach-transactional.username', 'aickey');
        $config->set('mail.mailers.mailcoach-transactional.password', $values['postal_token']);
    }
}
