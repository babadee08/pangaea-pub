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
}
