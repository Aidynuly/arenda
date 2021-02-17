<?php

declare(strict_types=1);

namespace App\Services\Traits;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use JsonSchema\Exception\ValidationException;

trait RestExceptionHandler
{
    private function resp($message = '', $statusCode = 200, $data = [], $error = false)
    {
        return response()->json([
            'statusCode' => $statusCode,
            'message' => $message,
            'error' => $error,
            'data' => $data
        ], 200);
    }

    /**
     * Determines if request is an api call.
     *
     * If the request URI contains '/api'.
     *
     * @param Request $request
     * @return bool
     */
    protected function isApiCall(Request $request)
    {
        return strpos($request->getUri(), '/api') !== false;
    }

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param \Throwable $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, \Throwable $e)
    {
        switch (true) {
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound();
                break;
            case $this->isValidatorException($e):
                return $this->resp('Ошибка валидации', 422, $e->getMessage(), true);
                break;
            case $e instanceof AuthenticationException:
                return $this->resp('Тіркелмеген', 403, [], true);

            default:
                $retval = $this->badRequest($e->getMessage());
        }

        return $retval;
    }

    /**
     * Returns json response for generic bad request.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest($message='Bad request', $statusCode=400)
    {
        return $this->resp($message, 400, [], true);
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function modelNotFound($message='Record not found', $statusCode=404)
    {
        return $this->resp($message, 404, [], true);
    }

    /**
     * Returns json response.
     *
     * @param array|null $payload
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload=null, $statusCode=404)
    {
        $payload = $payload ?: [];

        return response()->json($payload, $statusCode);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param \Throwable $e
     * @return bool
     */
    protected function isModelNotFoundException(\Throwable $e)
    {
        return $e instanceof ModelNotFoundException;
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param \Throwable $e
     * @return bool
     */
    protected function isValidatorException(\Throwable $e)
    {
        return $e instanceof ValidationException;
    }
}
