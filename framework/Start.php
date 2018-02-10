<?php

namespace CrCms\Foundation;

use Illuminate\Contracts\Container\Container;

/**
 * Class Start
 * @package CrCms\Foundation
 */
class Start
{
    /**
     * @param Container $container
     * @param string $startContract
     */
    public static function run(Container $container, string $startContract)
    {
        $container->singleton(
            StartContract::class,
            $startContract
        );

        $container->make(StartContract::class)->start($container);
    }
}