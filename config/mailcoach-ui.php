<?php

return [
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
