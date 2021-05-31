<?php

namespace Unit;

use App\Events\MessagePublishedEvent;
use App\Models\Topic;
use App\Services\PublisherService;
use Illuminate\Support\Facades\Event;
use TestCase;

class PublisherServiceTest extends TestCase
{
    /**
     * @test
     */
    public function message_published_event_was_fired()
    {
        Event::fake();

        /** @var Topic $topic */
        $topic = $this->createTestTopic();

        $service = new PublisherService();
        $service->publishMessage($topic, []);

        Event::assertDispatched(MessagePublishedEvent::class, function ($event) use ($topic) {
            return $event->topic->name === $topic->name;
        });
    }
}
