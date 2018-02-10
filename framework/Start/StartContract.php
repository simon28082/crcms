<?php

namespace CrCms\Foundation;

use Illuminate\Contracts\Container\Container;

/**
 * Interface StartContract
 * @package CrCms\Foundation
 */
interface StartContract
{
    /**
     * @param Container $container
     * @return mixed
     */
    public function start(Container $app);
}