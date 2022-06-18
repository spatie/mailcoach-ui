<?php

namespace Spatie\MailcoachUi\Models;

use Illuminate\Database\Eloquent\Casts\AsEncryptedArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Mailcoach\Domain\Shared\Models\HasUuid;
use Spatie\MailcoachUi\Enums\MailerTransport;

class Mailer extends Model
{
    use HasFactory;
    use HasUuid;
    use UsesMailcoachUiModels;

    public $table = 'mailcoach_mailers';

    public $guarded = [];

    public $casts = [
        'default' => 'boolean',
        'transport' => MailerTransport::class,
        'configuration' => AsEncryptedArrayObject::class,
        'ready_for_use' => 'boolean',
    ];

    public static function registerAllConfigValues(): void
    {
        self::getMailerClass()::all()
            ->where('ready_for_use', true)
            ->each(fn (Mailer $mailer) => $mailer->registerConfigValues());
    }

    public function registerConfigValues()
    {
        if (! $this->ready_for_use) {
            return;
        }

        switch ($this->transport) {
            case MailerTransport::Ses:
                config()->set("mail.mailers.{$this->configName()}", [
                    'transport' => 'ses',
                    'key' => $this->get('ses_key'),
                    'secret' => $this->get('ses_secret'),
                    'region' => $this->get('ses_region'),
                    'timespan_in_seconds' => $this->get('timespan_in_seconds'),
                    'mails_per_timespan' => $this->get('mails_per_timespan'),
                ]);

                config()->set("mailcoach.ses_feedback.configuration_set", $this->get('ses_configuration_set'));

                break;
            case MailerTransport::SendGrid:
                config()->set("mail.mailers.{$this->configName()}", [
                    'transport' => 'sendgrid',
                    'key' => $this->get('apiKey'),
                    'timespan_in_seconds' => $this->get('timespan_in_seconds'),
                    'mails_per_timespan' => $this->get('mails_per_timespan'),
                ]);

                config()->set('mailcoach.sendgrid.signing_secret', $this->get('signing_secret'));

                break;
            case MailerTransport::Smtp:
                config()->set("mail.mailers.{$this->configName()}", [
                    'transport' => 'smtp',
                    'host' => $this->get('host'),
                    'username' => $this->get('username'),
                    'password' => $this->get('password'),
                    'encryption' => $this->get('encryption'),
                    'port' => $this->get('port'),
                    'timespan_in_seconds' => $this->get('timespan_in_seconds'),
                    'mails_per_timespan' => $this->get('mails_per_timespan'),
                ]);

                break;
            case MailerTransport::Postmark:
                config()->set("mail.mailers.{$this->configName()}", [
                    'transport' => 'postmark',
                    'token' => $this->get('apiKey'),
                    'message_stream_id' => $this->get('streamId'),
                ]);

                config()->set("mailcoach.postmark_feedback.signing_secret", $this->get('signing_secret'));

                break;
            case MailerTransport::Mailgun:
                config()->set("mail.mailers.{$this->configName()}", [
                    'transport' => 'mailgun',
                    'domain' => $this->get('domain'),
                    'secret' => $this->get('apiKey'),
                    'endpoint' => $this->get('baseUrl'),
                ]);

                config()->set("mailcoach.mailgun_feedback.signing_secret", $this->get('signing_secret'));

                break;
        }
    }

    public function configName(): string
    {
        return Str::kebab("mailcoach-{$this->name}");
    }

    public function isReadyForUse(): bool
    {
        return $this->ready_for_use;
    }

    public function get(string $configurationKey, ?string $default = null)
    {
        return Arr::get($this->configuration, $configurationKey) ?? $default;
    }

    public function merge(array $values): self
    {
        $newValues = array_merge($this->configuration?->toArray() ?? [], $values);

        $this->update(['configuration' => $newValues]);

        return $this;
    }

    public function markAsReadyForUse(): self
    {
        $this->update(['ready_for_use' => true]);

        return $this;
    }
}
