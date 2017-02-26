<?php

namespace App\Http\Controllers\Api;
use App\User as UserModel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Exception\ValidationHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use Helpers;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function Login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);

        $validator = Validator::make($credentials, [
            'username' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $user= new UserModel();
        $userid=$user->select('id')->where('username',$request->username)->where('password',$request->password)->get();

        if($userid[0]->id != NULL){
            try {
                if(!$token=JWTAuth::fromUser($user->find($userid[0]->id))){ //token
                    return response()->json(['error' => 'invalid_credentials'], 401);
                }else{
                    return response()->json([
                       'status_code'=>0,
                        'data'=>$token
                    ]);
                }
            } catch (Exception $ex) {
                return response()->json([
                    'status_code'=>1,
                    'message'=>$ex->getMessage()
                ]);
            }
        }
    }
}
