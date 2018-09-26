<?php

return [

    'default' => 'consul',




    'connections' => [
        'consul' => [
            'register' => [
                'uri' => 'v1/agent/service/register',
                'id' => 's10',
                'name' => 'test_abc',
                'tags' => [],
                'enableTagOverride' => false,
                'service' => [
                    'address' => 'localhost',
                    'port' => '8099',
                ],
                /*'check' => [
                    'id' => '',
                    'name' => '',
                    'tcp' => 'localhost:8099',
                    'interval' => 10,
                    'timeout' => 1,
                ],*/
            ],
            'discovery' => [
                'uri' => 'v1/catalog/service',
                'services' => [
                    'user',
                    'passport'
                ],
            ],
            'driver' => [
                'name' => 'http',
                'headers' => [
                    'User-Agent' => 'CRCMS-JSON-RPC PHP Client',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]
            ],
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Connection pool selector
    |--------------------------------------------------------------------------
    |
    | Different selectors can be selected to select the connection in the connection pool
    | RandSelector: Randomly select an available selector
    | RingSelector: A ring selector to ensure scheduling equalization
    | ResidentSelector: Always use the same available selector
    | PopSelector: Swoole coroutines are used, each time an independently generated connection
    */

    'selector' => \CrCms\Foundation\Rpc\Client\Selectors\RandSelector::class,
];