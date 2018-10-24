<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Swoole servers
    |--------------------------------------------------------------------------
    |
    | All swoole server collections
    | *.settings.log_level: 0 =>DEBUG 1 =>TRACE 2 =>INFO 3 =>NOTICE 4 =>WARNING 5 =>ERROR
    |
    */

    'servers' => [
        'micro-service' => [
            'host' => '0.0.0.0',
            'port' => 22,
            'mode' => defined('SWOOLE_PROCESS') ? SWOOLE_PROCESS : 3,
            'type' => defined('SWOOLE_SOCK_TCP') ? SWOOLE_SOCK_TCP : 1,
            'settings' => [
                'user' => env('SWOOLE_USER'),
                'group' => env('SWOOLE_GROUP'),
                'log_level' => 4,
                'log_file' => storage_path('logs/micro-service.log'),
            ]
        ],
        'http' => [
            'host' => '0.0.0.0',
            'port' => 28080,
            'mode' => defined('SWOOLE_PROCESS') ? SWOOLE_PROCESS : 3,
            'type' => defined('SWOOLE_SOCK_TCP') ? SWOOLE_SOCK_TCP : 1,
            'settings' => [
                'user' => env('SWOOLE_USER'),
                'group' => env('SWOOLE_GROUP'),
                'log_level' => 4,
                'log_file' => storage_path('logs/http.log'),
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | ProcessManager file
    |--------------------------------------------------------------------------
    |
    | Information file for saving all running processes
    |
    */

    'process_file' => storage_path('process.pid'),

    /*
    |--------------------------------------------------------------------------
    | Swoole Process Prefix
    |--------------------------------------------------------------------------
    |
    | Server process name prefix
    |
    */

    'process_prefix' => 'swoole',
];