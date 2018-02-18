<?php

namespace CrCms\Foundation\Swoole\Events;

use Swoole\Server;

abstract class AbstractEvent implements EventContract
{
    /**
     * @var Server
     */
    protected $server;

    public function handle(Server $server) : void
    {
        $this->server = $server;
    }

    public function getServer(): Server
    {
        return $this->server;
    }
}