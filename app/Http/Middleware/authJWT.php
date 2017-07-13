<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;

use Illuminate\Support\Facades\Validator;
use Dingo\Api\Exception\ValidationHttpException;

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
        $method = $request->method();

        try {

            if ($request->isMethod('post')) {
                $user = JWTAuth::toUser($request->input('token'));
            }elseif($request->isMethod('get')){
                $validator = Validator::make($request->all(), ['token' => 'required']);
                if ($validator->fails()) {
                    throw new ValidationHttpException($validator->errors()->all());
                }
                $user        = JWTAuth::parseToken()->toUser();
            }

        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return apiResponse('failed','Token is Invalid');
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return apiResponse('failed','Token is Expired','',419);
                // try
                // {
                //     $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                //     $user = JWTAuth::setToken($refreshed)->toUser();
                //     header('Authorization: Bearer ' . $refreshed);
                // }
                // catch (JWTException $e)
                // {
                //     return apiResponse('failed','Token is  not refreshable');
                 // return response()->json([
                 //   'code'   => 103 ,// means not refreshable 
                 //   'response' => null // nothing to show 
                 //   ]);
                // }
            }else{
                return apiResponse('failed','Something is wrong');
            }
        }
        return $next($request);
    }
}
