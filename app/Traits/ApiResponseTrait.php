<?php

namespace App\Traits;

use Error;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;

trait ApiResponseTrait
{

    /**
     * @param array $data
     * @param int $statusCode
     * @param array $headers
     * @return array
     */
    public function parseGivenData($data = [], $statusCode = 200, $headers = []): array
    {
        $responseStructure = [
            'status' => $data['status'],
            'message' => $data['message'] ?? null,
            'result' => $data['result'] ?? null,
        ];
        if (isset($data['errors'])) {
            $responseStructure['errors'] = $data['errors'];
        }

        if (isset($data['exception']) && ($data['exception'] instanceof Error || $data['exception'] instanceof Exception)) {
            if (config('app.env') !== 'production') {
                $responseStructure['exception'] = [
                    'message' => $data['exception']->getMessage(),
                    'file' => $data['exception']->getFile(),
                    'line' => $data['exception']->getLine(),
                    'code' => $data['exception']->getCode(),
                    'trace' => $data['exception']->getTrace(),
                ];
            }
        }
        return ["content" => $responseStructure, "statusCode" => $statusCode, "headers" => $headers];
    }

    /**
     * Return generic json response with the given data.
     *
     * @param       $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function apiResponse($data = [], $statusCode = 200, $headers = []): JsonResponse
    {

        $result = $this->parseGivenData($data, $statusCode, $headers);

        return response()->json(
            $result['content'], $result['statusCode'], $result['headers']
        );
    }

    /**
     * @param JsonResource $resource
     * @param null $message
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondWithResource(JsonResource $resource, $message = null, $statusCode = 200, $headers = []): JsonResponse
    {

        return $this->apiResponse(
            [
                'status' => true,
                'result' => $resource,
                'message' => $message,
            ], $statusCode, $headers
        );
    }

    /**
     * @param ResourceCollection $resourceCollection
     * @param null $message
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondWithResourceCollection(ResourceCollection $resourceCollection, $message = null, $statusCode = 200, $headers = []): JsonResponse
    {

        return $this->apiResponse(
            [
                'status' => true,
                'message' => $message,
                'result' => $resourceCollection->response()->getData(),
            ], $statusCode, $headers
        );
    }

    /**
     * Respond with success.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondSuccess($message = '', $data = null): JsonResponse
    {
        return $this->apiResponse(['status' => true, 'message' => $message, 'result' => $data]);
    }

    /**
     * Respond with created.
     *
     * @param $data
     *
     * @return JsonResponse
     */
    protected function respondCreated($data): JsonResponse
    {
        return $this->apiResponse($data, 201);
    }

    /**
     * Respond with unauthorized.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondUnAuthorized($message): JsonResponse
    {
        return $this->respondError($message, 401);
    }

    /**
     * Respond with error.
     *
     * @param $message
     * @param int $statusCode
     *
     * @param Exception|null $exception
     * @param bool|null $error_code
     * @return JsonResponse
     */
    protected function respondError($message, int $statusCode = 400, ?Exception $exception = null, $errors = null, ?array $data = [] ): JsonResponse
    {
        return $this->apiResponse(
            [
                'status' => false,
                'message' => $message ?? __('messages.internal_error_try_again_later'),
                'exception' => $exception ?? null,
                'errors' => $errors,
                'result' => $data
            ], $statusCode
        );
    }

    /**
     * Respond with forbidden.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondForbidden($message): JsonResponse
    {
        return $this->respondError($message, 403);
    }

    /**
     * Respond with not found.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNotFound($message): JsonResponse
    {
        return $this->respondError($message, 404);
    }

    /**
     * Respond with internal error.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondInternalError($message, Exception $exception = null): JsonResponse
    {
        return $this->respondError($message, 400, $exception);
    }

    protected function respondValidationErrors(ValidationException $exception): JsonResponse
    {
        return $this->respondError($exception->getMessage(), 422, null, $exception->errors());
    }

    /**
     * Respond with Too Many Requests.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondToManyRequests($message): JsonResponse
    {
        return $this->respondError($message, 429);
    }

    /**
     * Respond with error.
     *
     * @param $message
     * @param int $statusCode
     *
     * @param Exception|null $exception
     * @param bool|null $error_code
     * @return JsonResponse
     */
    protected function respondWithError($message, int $statusCode = 400): JsonResponse
    {

        return $this->apiResponse(
            [
                'status' => false,
                'message' => $message,
            ], $statusCode
        );
    }


}
