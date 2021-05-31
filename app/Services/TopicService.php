<?php

namespace App\Services;

use App\Models\Topic;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TopicService
{
    public function getTopicByName(string $name): Topic
    {
        $topic = Topic::where('name', $name)->first();

        if (null === $topic) {
            throw new NotFoundHttpException('Unknown Topic');
        }

        return $topic;
    }
}
