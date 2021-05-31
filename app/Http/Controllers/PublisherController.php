<?php

namespace App\Http\Controllers;

use App\Components\AppResponse;
use App\Services\PublisherService;
use App\Services\TopicService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PublisherController extends Controller
{
    private PublisherService $publisherService;
    private TopicService $topicService;

    public function __construct(PublisherService $publisherService, TopicService $topicService)
    {
        $this->publisherService = $publisherService;
        $this->topicService = $topicService;
    }

    public function publish(Request $request, string $topic): JsonResponse
    {
        $this->validate($request, []);

        $topic = $this->topicService->getTopicByName($topic);

        $this->publisherService->publishMessage($topic, []);

        return AppResponse::success([], Response::HTTP_CREATED);
    }
}
