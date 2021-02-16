<?php

declare(strict_types=1);

namespace App\Services\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * @param string $message
     * @param null $data
     * @param int $errorCode
     * @param string $status
     * @return JsonResponse
     */
    public function response(string $message, $data = "", int $errorCode = 0, string $status = 'success'): JsonResponse
    {
        return response()->json([
            'error_code'    =>  $errorCode,
            'status'        =>  $status,
            'message'       =>  $message,
            'data'          =>  $data
        ]);
    }

    /**
     * Шаблон http json ответа
     *
     * @param string $message
     * @param $data
     * @param bool $success
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse(string $message, $data = null, bool $success = true, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data'    => $data,
            'code'    => $code
        ], $code);
    }

    /**
     * @param array $data
     * @return array
     */
    public function mockResponse(array $data = []): array
    {
        return [
            'error_code'    =>  0,
            'status'        =>  'success',
            'message'       =>  'success',
            'data'          =>  $data
        ];
    }
}
