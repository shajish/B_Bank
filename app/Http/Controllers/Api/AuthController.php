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
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $validator = Validator::make($credentials, [
            'email' => 'required',
            'password' => 'required',
            ]);
        if($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $user= new UserModel();
        // $userid=$user->select('id')->where('email',$request->email)->where('password',$request->password)->firstOrFail();
        $userid=$user->select('id')->where('email',$request->email)->where('password',$request->password)->get();
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
        }else{
            return response()->json([
                'status_code'=>1,
                'message'=>'Sorry, we couldnot log you in with the given credentials. You might want to check the credentials.'
                ]);
        }
    }
}
