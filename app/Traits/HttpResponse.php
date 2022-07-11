<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;

trait HttpResponse
{
    /**
     * Response success data
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return Response|ResponseFactory
     */
    protected function successResponse(mixed $data, string $message, int $statusCode = 200,): Response|ResponseFactory
    {
        return response([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Response error
     * @param string $message
     * @param int $statusCode
     * @return Response|ResponseFactory
     */
    protected function errorResponse( string $message, int $statusCode = 422, ): Response|ResponseFactory
    {
        return response([
            'status' => 'false',
            'message' => $message,
        ], $statusCode);
    }
}
