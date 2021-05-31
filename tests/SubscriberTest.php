<?php

use Laravel\Lumen\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;

class SubscriberTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function can_subscribe_to_topic()
    {
        $this->createTestTopic();

        $body = [
            'url' => 'https://mysubscriber.test',
        ];

        $response = $this->post('/subscribe/topic1', $body);

        $response->assertResponseStatus(Response::HTTP_CREATED);

        $response->seeJsonContains([
                'topic' => 'topic1',
                'url' => 'https://mysubscriber.test',
            ]);
    }

    /**
     * @test
     */
    public function cannot_subscribe_to_unknown_topic()
    {
        $body = [
            'url' => 'https://mysubscriber.test',
        ];

        $response = $this->post('/subscribe/topic2', $body);

        $response->assertResponseStatus(Response::HTTP_NOT_FOUND);

        $response->seeJsonContains([
            'status' => 'error',
            'message' => 'Unknown Topic',
        ]);
    }
}
