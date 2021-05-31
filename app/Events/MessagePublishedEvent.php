<?php

namespace App\Events;

use App\Models\Topic;

class MessagePublishedEvent extends Event
{
    public Topic $topic;
    public array $messageData;

    public function __construct(Topic $topic, array $messageData)
    {
        $this->topic = $topic;
        $this->messageData = $messageData;
    }
}
