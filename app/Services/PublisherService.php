<?php

namespace App\Services;

use App\Events\MessagePublishedEvent;
use App\Models\Topic;
use Illuminate\Support\Facades\Event;

class PublisherService
{
    public function publishMessage(Topic $topic, array $data): void
    {
        Event::dispatch(new MessagePublishedEvent($topic, $data));
    }

}
