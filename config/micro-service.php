<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | Service provider that needs to be loaded in a microservice environment
    |
    */

    'providers' => [
        \CrCms\Foundation\MicroService\Server\RouteServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Service server key
    |--------------------------------------------------------------------------
    |
    | Microservice interactive authentication key
    |
    */

    'secret' => env('SERVICE_SERVER_SECRET', null),
];