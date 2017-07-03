<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use App\Http\Controllers\Api\ApiController;

class authJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $apiControllerObject = new ApiController();

        try {
            $user = JWTAuth::toUser($request->input('token'));
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $apiControllerObject->apiResponse('failed','Token is Invalid');
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $apiControllerObject->apiResponse('failed','Token is Expired');
            }else{
                return $apiControllerObject->apiResponse('failed','Something is wrong');
            }
        }
        return $next($request);
    }
}
