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
        $userid=$user->select('id')->where('email',$request->email)->where('password',$request->password);
        if($userid->count() == 0 ){
            return apiResponse('failed','Invalid credentials.');
        }else{
            $userid=$userid->get();
            
            if($userid[0]->id != NULL){
                try {
                    if(!$token=JWTAuth::fromUser($user->find($userid[0]->id))){ //token
                        return apiResponse('failed','invalid_credentials');    
                    }else{
                        return response()->json([
                         'status_code'=>0,
                         'token'=>$token
                         ]);
                    }
                } catch (Exception $ex) {
                    return apiResponse('failed',$ex->getMessage());
                }
            }else{
                return apiResponse('failed','Sorry, we couldnot log you in with the given credentials. You might want to check the credentials.');
            }
        }

    }


    /**
     * { To log out }
     * @param      \Illuminate\Http\Request  $request  The request
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function logout(Request $request)
    {
        try {
            if (JWTAuth::parseToken()->invalidate()) {
                return $this->apiResponse('success',"logged out successfully");
            } else {
                return $this->apiResponse('success',"You are already inactive in our system for donating blood");
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
