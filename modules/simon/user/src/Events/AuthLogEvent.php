<?php

namespace Simon\User\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Simon\Mail\Repositorys\Interfaces\MailRepositoryInterface;
use Simon\User\Models\User;

class AuthLogEvent
{
    use InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */


    public $user = null;

    public $ip = 0;

    public $browser = '';

    public function __construct(User $User,int $type,int $ip,string $browser = '')
    {
        //
        $this->user = $User;
        $this->ip = $ip;
        $this->type = $type;
        $this->browser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
