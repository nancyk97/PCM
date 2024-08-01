<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * @param array $data
     * @param $message
     * @return JsonResponse
     */
    public function sendSuccessResponse($message, $data = []) : JsonResponse
    {
        $response = [
            'success' => true,
            'payload' => $data,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function sendErrorResponse($message, $code = 500)
    {
        $response = [
            'success' => false,
            'payload' => [],
            'message' => $message,
        ];
        return response()->json($response)->setStatusCode(!empty($code) ? $code : __('common.error_500'));
    }
}
