<?php

namespace CrCms\Foundation\Start\Drivers;

use CrCms\Foundation\StartContract;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Http\Kernel as HttpKernelContract;
use Illuminate\Http\Request;

/**
 * Class WebServer
 * @package CrCms\Foundation\Start\Drivers
 */
class WebServer implements StartContract
{
    /**
     * @param Container $app
     * @return mixed|void
     */
    public function start(Container $app)
    {
        $kernel = $app->make(HttpKernelContract::class);

        $response = $kernel->handle(
            $request = Request::capture()
        );

        $response->send();

        $kernel->terminate($request, $response);
    }
}