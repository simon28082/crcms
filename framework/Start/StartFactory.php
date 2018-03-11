<?php

namespace CrCms\Foundation;

use CrCms\Foundation\Start\Drivers\Artisan;
use CrCms\Foundation\Start\Drivers\Swoole;
use CrCms\Foundation\Start\Drivers\Laravel;

/**
 * Class Factory
 * @package CrCms\Foundation
 */
class StartFactory
{
    /**
     *
     */
    const TYPE_LARAVEL = 'laravel';

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
    public static function factory(string $type = self::TYPE_LARAVEL): string
    {
        return static::drivers()[$type];
    }

    /**
     * @return array
     */
    protected static function drivers(): array
    {
        return [
            self::TYPE_LARAVEL => Laravel::class,
            self::TYPE_SWOOLE => Swoole::class,
            self::TYPE_ARTISAN => Artisan::class,
        ];
    }
}