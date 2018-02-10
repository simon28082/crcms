<?php

namespace CrCms\Foundation;

use CrCms\Foundation\Start\Drivers\Artisan;
use CrCms\Foundation\Start\Drivers\Swoole;
use CrCms\Foundation\Start\Drivers\WebServer;

/**
 * Class Factory
 * @package CrCms\Foundation
 */
class StartFactory
{
    /**
     *
     */
    const TYPE_WEB_SERVER = 'web_server';

    /**
     *
     */
    const TYPE_SWOOLE = 'swoole';

    /**
     *
     */
    const TYPE_ARTISAN = 'artisan';

    /**
     * @param string $type
     * @return string
     */
    public static function factory(string $type = self::TYPE_WEB_SERVER): string
    {
        return static::drivers()[$type];
    }

    /**
     * @return array
     */
    protected static function drivers(): array
    {
        return [
            'web_server' => WebServer::class,
            'swoole' => Swoole::class,
            'artisan' => Artisan::class,
        ];
    }
}