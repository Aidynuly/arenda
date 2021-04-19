<?php

declare(strict_types=1);

namespace App\Services\Traits;

use App\Exceptions\DevMessageErrorInterface;
use App\Exceptions\Messages\Constant;
use App\Exceptions\NotAuthorizedException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use JsonSchema\Exception\ValidationException;

/**
 * Trait RestExceptionHandler
 * @package App\Services\Traits
 */
trait RestExceptionHandler
{
    /**
     * @param string $message
     * @param int $statusCode
     * @param array $data
     * @param false $error
     * @param string $devMessage
     * @return \Illuminate\Http\JsonResponse
     */
    private function resp($message = '', $statusCode = 200, $data = [], $error = false, $devMessage = 'server_error'):JsonResponse
    {
        $isDebugMode = config('app.debug') == true;

        return response()->json([
            'statusCode'    => $statusCode,
            'message'       => $message,
            'dev_message'   => $devMessage,
            'error'         => $error,
            'data'          => $isDebugMode ? $data : null,
        ], $statusCode);
    }

    /**
     * Determines if request is an api call.
     *
     * If the request URI contains '/api'.
     *
     * @param Request $request
     * @return bool
     */
    protected function isApiCall(Request $request): bool
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
    protected function getJsonResponseForException(Request $request, \Throwable $e): JsonResponse
    {
        switch (true) {
            case $e instanceof DevMessageErrorInterface:
                return $this->resp($e->getMessage(), 400, $e->getMessage(), true, $e->getDevMessage());
            case $this->isModelNotFoundException($e):
                return $this->resp('Не найдено', 404, $e->getMessage(), true, Constant::NOT_FOUND);
            case $this->isValidatorException($e):
                return $this->resp('Ошибка валидации', 422, $e->getMessage(), true, Constant::VALIDATION_ERROR);
            case $e instanceof AuthenticationException:
            case $e instanceof NotAuthorizedException:
                return $this->resp('Не авторизованы', 401, $e->getMessage(), true, Constant::NOT_AUTHORIZED);
            default:
                return $this->resp('Ошибка сервера', 500, $e->getMessage(), true, Constant::SERVER_ERROR);
        }
    }

    /**
     * Returns json response.
     *
     * @param array|null $payload
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload=null, $statusCode=404): JsonResponse
    {
        $payload = $payload ? : [];

        return response()->json($payload, $statusCode);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param \Throwable $e
     * @return bool
     */
    protected function isModelNotFoundException(\Throwable $e): bool
    {
        return $e instanceof ModelNotFoundException;
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param \Throwable $e
     * @return bool
     */
    protected function isValidatorException(\Throwable $e): bool
    {
        return $e instanceof ValidationException;
    }
}
