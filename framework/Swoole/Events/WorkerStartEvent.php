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
//
       /* $inotify = inotify_init();

        $a = inotify_add_watch($inotify,base_path(),IN_CREATE | IN_MODIFY | IN_DELETE | IN_MOVE_SELF);

        swoole_event_add($inotify,function()use ($inotify) {
            $events = inotify_read($inotify);
            if (!empty($events)) {
                //注意更新多个文件的间隔时间处理,防止一次更新了10个文件，重启了10次，懒得做了，反正原理在这里
                //Server::getInstance()->getServer()->reload();
                echo "Server Reload";
                $this->server->reload();
            }
        });*/
//        $events = inotify_read($inotify);
//        if ($events) {
//
//            $this->server->reload();
//        }
//
//        dump($a);

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