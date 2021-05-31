<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TopicSubscriberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function subscribe(Request $request, string $topic): JsonResponse
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        $topic = Topic::where('name', $topic)->first();

        $subscribed = new Subscriber;
        $subscribed->topic_id = $topic->id;
        $subscribed->url = $request->input('url');
        $subscribed->save();

        return response()->json([
            'url' => $subscribed->url,
            'topic' => $topic->name
        ], Response::HTTP_CREATED);
    }
}
