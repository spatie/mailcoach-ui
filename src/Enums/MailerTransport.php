<?php

namespace Spatie\MailcoachUi\Enums;

enum MailerTransport: string
{
    case Ses = 'ses';
    case SendGrid = 'sendgrid';

    public function label(): string
    {
        return ucfirst($this->value);
    }
}
