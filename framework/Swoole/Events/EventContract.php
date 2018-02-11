<?php

namespace CrCms\Foundation\Swoole\Events;

use Swoole\Server;

interface EventContract
{
    /**
     * @return void
     */
    public function handle(Server $server): void;
}