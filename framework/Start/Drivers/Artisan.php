<?php

namespace CrCms\Foundation\Start\Drivers;

use CrCms\Foundation\StartContract;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class Artisan implements StartContract
{
    public function start(Container $app)
    {
        $argvs = $_SERVER['argv'];
//        unset($argvs[1]);

        $kernel = $app->make(Kernel::class);

        $status = $kernel->handle(
            $input = new ArgvInput(array_values($argvs)),
            new ConsoleOutput
        );

        /*
        |--------------------------------------------------------------------------
        | Shutdown The Application
        |--------------------------------------------------------------------------
        |
        | Once Artisan has finished running, we will fire off the shutdown events
        | so that any final work may be done by the application before we shut
        | down the process. This is the last thing to happen to the request.
        |
        */

        $kernel->terminate($input, $status);

        exit($status);
    }

}