<?php

return [
    'host' => '127.0.0.1',
    'port' => 28080,
    'server_type' => 'http',
    'servers' => [
        'http' => [
            'drive' => Swoole\Http\Server::class,
            'params' => [],
        ],
        'web_socket' => [
            'drive' => \Swoole\WebSocket\Server::class,
            'params' => [],
        ],
        'tcp' => [
            'drive' => \Swoole\Server::class,
            'params' => [],
        ],
        'udp' => [
            'drive' => \Swoole\Server::class,
            'params' => [],
        ],
    ],
    'settings' => [
        'package_max_length' => 1024 * 1024 * 10//单位：B
    ],

    'notify' => [
        'targets' => [
            base_path('modules'),
            base_path('resources'),
        ],
        'monitor' => false,
        'log_path' => storage_path('logs/reload.log')
    ],
    'error_log' => storage_path('logs/error_%s.log'),
    'process_prefix' => 'swoole_',
    'pid_file' => storage_path('swoole.pid'),
    'request_log' => storage_path('logs/request-%s.log'),
    'events' => [
        'start' => \CrCms\Foundation\Swoole\Events\StartEvent::class,
        'worker_start' => \CrCms\Foundation\Swoole\Events\WorkerStartEvent::class,
        'worker_stop' => '',
        'worker_exit' => '',
        'connect' => '',
        'receive' => '',
        'packet' => '',
        'close' => \CrCms\Foundation\Swoole\Events\CloseEvent::class,
        'buffer_full' => '',
        'Buffer_empty' => '',
        'task' => '',
        'finish' => '',
        'pipe_message' => '',
        'worker_error' => '',
        'manager_start' => \CrCms\Foundation\Swoole\Events\ManagerStartEvent::class,
        'manager_stop' => '',

        'http' => [
            'request' => \CrCms\Foundation\Swoole\Events\Http\RequestEvent::class,
        ],

        'web_socket' => [
            'open'=>\CrCms\Foundation\Swoole\Events\WebSocket\OpenEvent::class,
            'message' => \CrCms\Foundation\Swoole\Events\WebSocket\MessageEvent::class,
//            'request' => \CrCms\Foundation\Swoole\Events\Http\RequestEvent::class,
        ]
    ]
];