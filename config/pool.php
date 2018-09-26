<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Pool Connection Name
    |--------------------------------------------------------------------------
    |
    */

    'default' => 'client',

    /*
    |--------------------------------------------------------------------------
    | Connection Pool Connections
    |--------------------------------------------------------------------------
    |
    | Connection pools are divided into different connection groups
    | Each connection group can have multiple connections
    | Determine which pool's connection is currently used by selecting a connection group
    |
    */

    'connections' => [
        'client' => [
            'max_idle_number' => 50,//最大空闲数
            'min_idle_number' => 15,//最小空闲数
            'max_connection_number' => 20,//最大连接数
            'max_connection_time' => 3,//最大连接时间(s)
        ],

        'passport' => [
            'max_idle_number' => 50,//最大空闲数
            'min_idle_number' => 15,//最小空闲数
            'max_connection_number' => 20,//最大连接数
            'max_connection_time' => 3,//最大连接时间(s)
        ],

        'consul' => [
            'max_idle_number' => 50,//最大空闲数
            'min_idle_number' => 15,//最小空闲数
            'max_connection_number' => 20,//最大连接数
            'max_connection_time' => 3,//最大连接时间(s)
        ]
    ],
];