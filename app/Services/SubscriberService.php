<?php


namespace App\Services;


use App\Models\Subscriber;
use App\Models\Topic;

class SubscriberService
{

    public function subscribeToTopic(Topic $topic, string $url): array
    {
        $subscriber = new Subscriber();
        $subscriber->topic()->associate($topic);
        $subscriber->url = $url;
        $subscriber->save();

        return [
            'url' => $subscriber->url,
            'topic' => $topic->name
        ];
    }
}
