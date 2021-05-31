<?php

namespace App\Listeners;

use App\Events\MessagePublishedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifySubscribersListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MessagePublishedEvent  $event
     * @return void
     */
    public function handle(MessagePublishedEvent $event)
    {
        //
    }
}
