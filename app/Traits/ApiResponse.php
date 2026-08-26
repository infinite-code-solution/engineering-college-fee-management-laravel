<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Common success response (200 OK).
     */
    public function successResponse(mixed $data, string $message = 'Success'): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    /**
     * Common error response (Non-200).
     */
    public function errorResponse(string $message, int $statusCode): JsonResponse
    {
        return response()->json([
            'status' => $statusCode,
            'message' => $message,
        ], $statusCode);
    }
}
