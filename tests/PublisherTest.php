<?php

use Symfony\Component\HttpFoundation\Response;

class PublisherTest extends TestCase
{
    /**
     * @test
     */
    public function message_can_be_published()
    {
        $this->createTestTopic();

        $body = [
            'message' => 'Hello, World!',
        ];

        $response = $this->post('/publish/topic1', $body);

        $response->assertResponseStatus(Response::HTTP_CREATED);

        $response->seeJsonContains([]);
    }
}
