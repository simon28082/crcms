<?php

namespace CrCms\Foundation\Swoole\Events;

use Swoole\Server;

class CloseEvent extends AbstractEvent implements EventContract
{
    /**
     * CloseEvent constructor.
     * @param Server $server
     * @param int $fd
     * @param int $reactorId
     */
    public function __construct(int $fd, int $reactorId)
    {
        $this->reactorId = $reactorId;
    }

    public function handle(Server $server): void
    {
    }
}