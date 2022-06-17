<?php

namespace Spatie\MailcoachUi\Models;

trait UsesMailcoachUiModels
{
    /** @return class-string<User> */
    public static function getUserClass(): string
    {
        return config('mailcoach-ui.models.user', User::class);
    }

    /** @return class-string<PersonalAccessToken> */
    public static function getPersonalAccessTokenClass(): string
    {
        return config('mailcoach-ui.models.personal_access_token', PersonalAccessToken::class);
    }

    /** @return class-string<Setting> */
    public static function getSettingClass(): string
    {
        return config('mailcoach-ui.models.setting', Setting::class);
    }

    /** @return class-string<Mailer> */
    public static function getMailerClass(): string
    {
        return config('mailcoach-ui.models.mailer', Mailer::class);
    }
}
