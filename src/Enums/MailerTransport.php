<?php

namespace Spatie\MailcoachUi\Enums;

enum MailerTransport: string
{
    case Ses = 'ses';
    case SendGrid = 'sendGrid';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
