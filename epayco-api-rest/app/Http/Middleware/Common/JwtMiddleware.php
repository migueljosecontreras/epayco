<?php

namespace App\Http\Middleware\Common;

use App\Helpers\Common\JWT;
use Closure;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */

    public function handle($request, Closure $next)
    {
        try {
            if(
                !JWT::validateJWTSignature($request->bearerToken() ?? $request->token)
            ){
                throw new TokenInvalidException('Token is Invalid');
            }

            \JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException){
                return response()->json(['msg' => 'Token is Invalid'], Response::HTTP_UNAUTHORIZED);
            }else if ($e instanceof TokenExpiredException){
                return response()->json(['msg' => 'Token is Expired'], Response::HTTP_UNAUTHORIZED);
            }else{
                return response()->json(['msg' => 'Authorization Token not found'], Response::HTTP_UNAUTHORIZED);
            }
        }
        return $next($request);
    }
}
