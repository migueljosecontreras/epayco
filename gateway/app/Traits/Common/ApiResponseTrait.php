<?php

namespace App\Traits\Common;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    public function requestResponse($data, $statusCode) : JsonResponse
    {
        return response()->json($data, $statusCode);
    }
}
