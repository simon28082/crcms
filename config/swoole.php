<?php

return [
    'host' => '0.0.0.0',
    'port' => 22,
    'settings' => [

    ],
    'events' => [
        'start' => '',
        'worker_start' => '',
        'worker_stop' => '',
        'worker_exit' => '',
        'connect' => '',
        'receive' => '',
        'packet' => '',
        'close' => '',
        'buffer_full' => '',
        'Buffer_empty' => '',
        'task' => '',
        'finish' => '',
        'pipe_message' => '',
        'worker_error' => '',
        'manager_start' => '',
        'manager_stop' => '',
        'message' => '',
        'request' => \CrCms\Foundation\Swoole\Events\Request::class,
    ]
];