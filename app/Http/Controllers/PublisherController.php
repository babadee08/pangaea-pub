<?php

namespace App\Http\Controllers;

use App\Components\AppResponse;
use App\Services\TopicService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PublisherController extends Controller
{

    private TopicService $topicService;

    public function __construct(TopicService $topicService)
    {
        $this->topicService = $topicService;
    }

    public function publish(Request $request, string $topic): JsonResponse
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        $topic = $this->topicService->getTopicByName($topic);

        return AppResponse::success([], Response::HTTP_CREATED);
    }
}
