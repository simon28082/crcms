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
        CrCms\Foundation\Http\Providers\HttpServiceProvider::class,
        CrCms\Foundation\App\Providers\RouteServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Disable Service Providers
    |--------------------------------------------------------------------------
    |
    | Run mode loading is temporarily disabled when auto-discovery of Laravel packages is enabled.
    | So all loaded auto-discovered packages will be loaded. This function removes the non-loaded ServiceProvider in the specified mode.
    |
    */

    'disable_providers' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Reload Service Providers
    |--------------------------------------------------------------------------
    |
    | If there is a static closure, it is dangerous to write the app object that was initialized before, causing problems with subsequent new request calls.
    | Considering from the project, if some third-party packages use this method, there must be hidden problems.
    | If the error can be promptly reported, the user can be sure to find out where there is variable pollution.
    | I don't know if I can solve the problem. When the object is used up, it will be initialized to null.
    | This will ensure that the next call to the closure will be reported in time, and the wrong data will not appear.
    |
    */

    'reload_providers' => [
        \Illuminate\Auth\AuthServiceProvider::class,
        \Illuminate\Pagination\PaginationServiceProvider::class,
    ],
];