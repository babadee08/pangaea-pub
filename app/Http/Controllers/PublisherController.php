<?php

namespace App\Http\Controllers;

use App\Components\AppResponse;
use App\Services\PublisherService;
use App\Services\TopicService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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

    /**
     * @throws ValidationException
     */
    public function publish(Request $request, string $topic): JsonResponse
    {
        if (!is_array($request->all()) || empty($request->all())) {
            return AppResponse::error('Invalid data');
        }

        $data = $request->all();

        $topic = $this->topicService->getTopicByName($topic);

        $this->publisherService->publishMessage($topic, $data);

        return AppResponse::success([
            'topic' => $topic->name,
            'data' => $data,
        ], Response::HTTP_CREATED);
    }
}
