<?php


use App\Events\MessagePublishedEvent;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response;

class PublisherTest extends TestCase
{

    /**
     * @test
     */
    public function message_published_event_was_fired()
    {
        Event::fake();

        $topic = $this->createTestTopic();

        $body = [
            'url' => 'https://mysubscriber.test',
        ];

        $this->post('/publish/topic1', $body);

        Event::assertDispatched(MessagePublishedEvent::class, function ($event) use ($topic) {
            return $event->topic->name === $topic->name;
        });
    }

    /**
     * @test
     */
    public function message_can_be_published()
    {
        $this->createTestTopic();

        $body = [
            'url' => 'https://mysubscriber.test',
        ];

        $response = $this->post('/publish/topic1', $body);

        $response->assertResponseStatus(Response::HTTP_CREATED);

        $response->seeJsonContains([]);
    }
}
