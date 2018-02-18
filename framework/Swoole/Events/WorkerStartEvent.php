<?php

namespace CrCms\Foundation\Swoole\Events;

use Swoole\Server;

/**
 * Class WorkStartEvent
 * @package CrCms\Foundation\Swoole\Events
 */
class WorkerStartEvent extends AbstractEvent implements EventContract
{
    protected $workId;

    public function __construct(int $workId)
    {
        $this->workId = $workId;
    }

    public function handle(Server $server) : void
    {
        parent::handle($server);

//        inotify_init();
//        if ($this->workId == 1) {
//            echo "123";
//            //$inotify = inotify_init();
//            $this->server->reload();
//        }

//        $a = \inotify_add_watch($inotify,base_path(),IN_CREATE|IN_MODIFY|IN_DELETE);
//        dump($a);
    }


}