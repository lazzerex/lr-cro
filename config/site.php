<?php

/**
 * Author: Pinebranch
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Date format
    |--------------------------------------------------------------------------
    */
    'date_format' => 'd/m/Y',
    'datetime_format' => 'd/m/Y H:i',

    /*
    |--------------------------------------------------------------------------
    | Available locales
    |--------------------------------------------------------------------------
    |
    | List all locales that your application works with
    |
    */
    'available_locales' => [
        [
            'name' => 'vi',
            'label' => 'Tiếng Việt',
        ],
        [
            'name' => 'en',
            'label' => 'English',
        ],
    ],

    'default_locale' => 'vi',

    /*
    |--------------------------------------------------------------------------
    | Master Admin Id & Admin Role Id
    |--------------------------------------------------------------------------
    |
    | ID of user who is master admin (has all permissions, can not be deleted)
    */

    'master_admin_id' => [16],
    'master_admin_role_id' => 1,

    /*
    |--------------------------------------------------------------------------
    | Activity Log
    |--------------------------------------------------------------------------
    |
    */

    'activity_log_excluded' => ['updated_at'],
];
