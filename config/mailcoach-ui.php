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

    /*
     * The valuestore class that should be used to store the Mailcoach UI settings
     */
    'valuestore' => \Spatie\Valuestore\Valuestore::class,
];
