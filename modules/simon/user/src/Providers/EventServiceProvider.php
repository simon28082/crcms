<?php

namespace Simon\User\Providers;

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
        'Simon\User\Events\AuthLogEvent' => [
            'Simon\User\Listeners\AuthLogListener',
        ],
    ];

}
