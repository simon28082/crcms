<?php

namespace Simon\Mail\Listeners;

use Simon\Mail\Events\MailLogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Simon\Mail\Repositorys\Interfaces\MailRepositoryInterface;

class MailLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    protected $repository = null;


    public function __construct(MailRepositoryInterface $Mail)
    {
        //
        $this->repository = $Mail;
    }

    /**
     * Handle the event.
     *
     * @param  MailLogEvent  $event
     * @return void
     */
    public function handle(MailLogEvent $event)
    {
        //
        $this->repository->create([
            'to'=>$event->to,
            'content'=>$event->content,
            'type'=>$event->type,
        ]);
    }
}
