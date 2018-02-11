<?php

namespace CrCms\Foundation\Swoole\Events;

use Swoole\Server;

abstract class AbstractEvent
{

    protected $server;

    protected $fd;

    protected $reactorId;
}