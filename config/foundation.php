<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Turn on XSS filtering
    |--------------------------------------------------------------------------
    |
    | Turn on XSS filtering in the Resource resource
    |
    */

    'filter_xss' => true,

    /*
    |--------------------------------------------------------------------------
    | Define the application's command schedule.
    |--------------------------------------------------------------------------
    |
    | Enter different execution classes
    | You must implement the interface CrCms\Foundation\Console\ScheduleDispatchContract
    |
    | Example
    | App\Schedules\Clear::class
    |
    */

    'schedules' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | API Version
    |--------------------------------------------------------------------------
    |
    | Stored in the currently available version of the header X-CRCMS-Media-Version
    |
    */
    'api_version' => env('API_VERSION', 'crcms.v1'),

    /*
    |--------------------------------------------------------------------------
    | API Type
    |--------------------------------------------------------------------------
    |
    | Stored in the currently available version of the header X-CRCMS-Media-Type
    |
    */
    'api_type' => env('API_TYPE', 'crcms.restful'),

    /*
    |--------------------------------------------------------------------------
    | Passport setting
    |--------------------------------------------------------------------------
    |
    */
    'passport' => [
        'key' => env('PASSPORT_KEY', null),
        'secret' => env('PASSPORT_SECRET', null),
        'host' => env('PASSPORT_HOST', null),
        'ssl' => env('PASSPORT_SSL', null),
        'routes' => [
            'login' => env('PASSPORT_HOST', null) . '/login',
            'refresh' => 'passport.api.v1.refresh-token',
            'user' => 'passport.api.v1.user',
            'check' => 'passport.api.v1.check-login',
            'logout' => 'passport.api.v1.logout',
        ],
        'user' => \CrCms\App\User::class,
    ],
];