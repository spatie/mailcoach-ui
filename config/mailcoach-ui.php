<?php

return [
    /**
     * The available editors inside Mailcoach UI, the key is the displayed name in the UI
     * the class must be a class that extends and implements
     * \Spatie\MailcoachUi\Support\EditorConfiguration\Editors\EditorConfigurationDriver
     */
    'editors' => [
        \Spatie\MailcoachUi\Support\EditorConfiguration\Editors\EditorJsEditorConfigurationDriver::class,
        \Spatie\MailcoachUi\Support\EditorConfiguration\Editors\MarkdownEditorConfigurationDriver::class,
        \Spatie\MailcoachUi\Support\EditorConfiguration\Editors\MonacoEditorConfigurationDriver::class,
        \Spatie\MailcoachUi\Support\EditorConfiguration\Editors\TextareaEditorConfigurationDriver::class,
        \Spatie\MailcoachUi\Support\EditorConfiguration\Editors\UnlayerEditorConfigurationDriver::class,
    ],

    /*
     *  These middleware will be assigned to every Mailcoach app UI route, giving you the chance
     *  to add your own middleware to this stack or override any of the existing middleware.
     */
    'middleware' => [
        'web',
    ],

    /*
     * The relative url to redirect to after the user is authenticated.
     */
    'url_after_login' => 'campaigns',

    'mailer_encryption_key' => '6rE9Nz59bGRbeMATftriyQjrpF7DcOQm',

    /**
     * You might want to override the default models used by Mailcoach UI
     * Make sure to extend their respective base models when overriding
     * with a model of your own.
     */
    'models' => [
        'user' => \Spatie\MailcoachUi\Models\User::class,
        'personal_access_token' => \Spatie\MailcoachUi\Models\PersonalAccessToken::class,
        'setting' => \Spatie\MailcoachUi\Models\Setting::class,
        'mailer' => \Spatie\MailcoachUi\Models\Mailer::class,
    ],
];
