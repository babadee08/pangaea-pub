<?php

namespace App\Http\Controllers;

use App\Components\AppResponse;
use App\Services\SubscriberService;
use App\Services\TopicService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TopicSubscriberController extends Controller
{
    private SubscriberService $subscriberService;

    private TopicService $topicService;

    public function __construct(SubscriberService $subscriberService, TopicService $topicService)
    {
        $this->subscriberService = $subscriberService;
        $this->topicService = $topicService;
    }

    public function subscribe(Request $request, string $topic): JsonResponse
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        $topic = $this->topicService->getTopicByName($topic);

        $response = $this->subscriberService->subscribeToTopic($topic, $request->input('url'));

        return AppResponse::success($response, Response::HTTP_CREATED);
    }
}
