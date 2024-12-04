<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait RespondsWithHttpStatus
{
    protected function success($message, $data = [], $status = Response::HTTP_OK)
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function successWithPagination($message, $data = [], $status = Response::HTTP_OK)
    {
        return response([
            'success' => true,
            'data' => $data['data'] ?? null,
            'links' => $data['links'],
            'meta' => $data['meta'],
            'message' => $message,
        ], $status);
    }

    protected function failure($message, $status = Response::HTTP_BAD_REQUEST)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }

    protected function validationFailure($errors, $status = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response([
            'message' => "The given data was invalid.",
            "errors" => $errors
        ], $status);
    }
}
