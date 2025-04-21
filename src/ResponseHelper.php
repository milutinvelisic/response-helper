<?php

namespace MilutinVelisic\ResponseHelper;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ResponseHelper
{
    /**
     * Generate a successful JSON response.
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function success($data = null, $message = null, $statusCode = 200): JsonResponse
    {
        return response()->json([
            'message' => $message ?? 'Success',
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Generate an error JSON response.
     *
     * @param Exception $exception
     * @param string|null $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function error(Exception $exception, $message = null, $statusCode = 400): JsonResponse
    {
        Log::error($exception->getMessage());

        return response()->json([
            'message' => $message ?? 'Failed',
            'error' => $exception->getMessage(),
            'data' => null,
        ], $statusCode);
    }

    /**
     * Generate a custom JSON response.
     *
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function json(array $data, int $statusCode = 200): JsonResponse
    {
        return response()->json($data, $statusCode);
    }
}