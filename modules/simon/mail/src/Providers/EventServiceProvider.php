<?php

namespace Simon\Mail\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Simon\Mail\Events\MailLogEvent' => [
            'Simon\Mail\Listeners\MailLogListener',
        ],
    ];

}
