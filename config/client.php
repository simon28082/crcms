<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/6/26 6:19
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Client name
    |--------------------------------------------------------------------------
    |
    */
    'default' => 'consul',

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
        'http' => [
            'driver' => 'http',
            'host' => 'baidu.com',
            'port' => 80,
            'settings' => [
                'timeout' => 1,
                //'ssl' => env('PASSPORT_SSL', true),
            ],
        ],
        'consul' => [
            'driver' => 'http',
            'host' => '192.168.1.12',
            'port' => 8500,
            'settings' => [
                'timeout' => 1,
                //'ssl' => env('PASSPORT_SSL', true),
            ],
        ],
    ],
];