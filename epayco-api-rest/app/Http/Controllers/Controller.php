<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Traits\Common\ApiResponseTrait;

/**
 * @OA\Info(
 *    title="Users Api Doc",
 *    version="1.0.0",
 *    description="mipc makertplace",
 * )
 * 
 * *    @OA\Server(
 *         description="API server",
 *         url="http://localhost:8085",
 *     ),
 */

 /**
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * )
 */
class Controller extends BaseController
{
    use ApiResponseTrait;
}
