<?php

namespace App\Traits\Common;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    public function response($data, $message = null, $statusCode = Response::HTTP_OK) : JsonResponse
    {
        return response()->json(   [
                                    'success'       => true,
                                    'cod_error' => '00',
                                    'message_error' => null,
                                    'message'       => $message ?? trans('general.msg.success'),
                                    'data'          => $data,
                                ], $statusCode);
    }

    public function validationErrorResponse($errors, $message = null, $statusCode = Response::HTTP_BAD_REQUEST) : JsonResponse
    {
        return response()->json(   [
                                    'success'       => false,
                                    'cod_error' => '40',
                                    'message_error' => $message ?? trans('general.msg.invalidData'),
                                    'message'       => $message ?? trans('general.msg.invalidData'),
                                    'errors'        => $errors,
                                ], $statusCode);
    }

    public function internalErrorResponse($message = null, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR) : JsonResponse
    {
        return response()->json(   [
                                    'success'       => false,
                                    'cod_error' => '51',
                                    'message_error' => $message ?? trans('general.msg.error'),
                                    'message'       => $message ?? trans('general.msg.error'),
                                ], $statusCode);
    }

    public function unauthorizedResponse($message = null) : JsonResponse
    {
        return response()->json(   [
                                    'success'       => false,
                                    'cod_error' => '41',
                                    'message_error' => $message ?? trans('general.msg.unauthorized'),
                                    'message'       => $message ?? trans('general.msg.unauthorized'),
                                ], Response::HTTP_UNAUTHORIZED);
    }

    public function notFoundResponse($message = null, $statusCode = Response::HTTP_NOT_FOUND) : JsonResponse
    {
        return response()->json(   [
                                    'success'       => false,
                                    'cod_error' => '44',
                                    'message_error' => $message ?? trans('general.msg.notFound'),
                                    'message'       => $message ?? trans('general.msg.notFound'),
                                    'data'          => null,
                                ], $statusCode);
    }
}
