<?php

namespace App\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Format response.
 */
class ResponseHelper
{
    /**
     * API Response
     *
     * @var array
     */
    public static array $response = [
        'meta' => [
            'code' => null,
            'status' => 'success',
            'message' => null,
        ],
        'data' => null,
        'success' => true
    ];

    /**
     * Give success response.
     * @param mixed|null $data
     * @param mixed|null $message
     * @param int $code
     * @return JsonResponse
     */
    public static function success(mixed $data = null, string $message = null, int $code = Response::HTTP_OK): JsonResponse
    {
        self::$response['meta']['message'] = $message;
        self::$response['meta']['code'] = $code;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    /**
     * Give error response.
     * @param mixed|null $data
     * @param mixed|null $message
     * @param int $code
     * @return JsonResponse
     */
    public static function error(mixed $data = null, mixed $message = null, int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;
        self::$response['success'] = false;

        $response = response()->json(self::$response, self::$response['meta']['code']);

        throw new HttpResponseException($response);
    }

    public static function successWithPagination(LengthAwarePaginator $paginator, mixed $data = null, string $message = null, int $code = Response::HTTP_OK): JsonResponse
    {
        // Format pagination
        $pagination = [
            'current_page' => $paginator->currentPage(),
            'last_page'    => $paginator->lastPage(),
            'per_page'     => $paginator->perPage(),
            'total'        => $paginator->total(),
            'from'         => $paginator->firstItem() ?? 0, 
            'to'           => $paginator->lastItem() ?? 0
        ];

        // Gabungkan data dan pagination
        $responseData = [
            'paginate' => $pagination,
            'data'     => $data ?? $paginator->items()
        ];

        return self::success($responseData, $message, $code);
    }
}
