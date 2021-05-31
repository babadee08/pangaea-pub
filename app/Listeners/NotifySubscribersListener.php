<?php

namespace App\Listeners;

use App\Events\MessagePublishedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotifySubscribersListener implements ShouldQueue
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
        $topic = $event->topic;

        $data = $event->messageData;

        /** @var Collection $subscribers */
        $subscribers = $topic->subscribers;

        foreach ($subscribers as $subscriber) {
            $url = $subscriber->url;
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post($url, [
                'topic' => $topic->name,
                'data' => $data
            ]);

            if ($response->successful()) {
                Log::notice("Subscriber {$subscriber->id} notified");
            }
            if ($response->failed()) {
                Log::error('Some errors were made');
            }
        }
    }
}
