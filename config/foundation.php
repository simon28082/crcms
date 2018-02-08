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

    'expanders' => [
        'http' => CrCms\Foundation\Http\KernelExpander::class,
        'console' => CrCms\Foundation\Console\KernelExpander::class,
    ]
];