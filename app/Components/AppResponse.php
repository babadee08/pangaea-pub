<?php

namespace App\Components;


use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AppResponse
{
    const STATUS_ERROR = 'error';

    const LABEL_STATUS = 'status';
    const LABEL_DATA = 'data';
    const LABEL_MESSAGE = 'message';

    /**
     * Returns a success response
     */
    public static function success(array $data = [], int $http_status = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $http_status);
    }

    /**
     * Returns a error response
     */
    public static function error(string $message, array $data = null, int $http_status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json([
            self::LABEL_STATUS => self::STATUS_ERROR,
            self::LABEL_MESSAGE => $message,
            self::LABEL_DATA => $data
        ])->setStatusCode($http_status);
    }

}
