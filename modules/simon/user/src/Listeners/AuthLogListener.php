<?php

namespace Simon\User\Listeners;

use Simon\User\Events\AuthLogEvent;
use Simon\Mail\Events\MailLogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Simon\User\Repositorys\Interfaces\AuthLogRepositoryInterface;

class AuthLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    protected $repository = null;


    public function __construct(AuthLogRepositoryInterface $AuthLog)
    {
        //
        $this->repository = $AuthLog;
    }

    /**
     * Handle the event.
     *
     * @param  MailLogEvent  $event
     * @return void
     */
    public function handle(AuthLogEvent $event)
    {
        //
        $this->repository->logByAuth($event->user,$event->type,$event->ip,$event->browser);
    }
}
