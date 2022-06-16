<?php

namespace Spatie\MailcoachUi\Enums;

enum MailerTransport: string
{
    case Ses = 'ses';
    case SendGrid = 'sendGrid';
    case Smtp = 'smtp';
    case Postmark = 'postmark';
    case Mailgun = 'mailgun';

    public function label(): string
    {
        return match($this) {
            self::Ses => 'SES',
            self::SendGrid => 'SendGrid',
            self::Smtp => 'SMTP',
            self::Postmark => 'Postmark',
            self::Mailgun => 'Mailgun',
        };
    }
}
