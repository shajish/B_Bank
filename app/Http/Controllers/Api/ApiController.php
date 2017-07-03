<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\BloodGroups as BloodGroupModel;
use App\User as UserModel;
use App\Models\RoleUsers as RoleModel;
use App\Models\Districts as DistrictModel;
use App\Models\UserProfiles as UserProfileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ApiController extends Controller
{

 

    /* api for-> fetching out blood group*/
    public function getBloodGroup()
    {
        try {
            $category = new BloodGroupModel();
            $data     = $category->all();
            return response()->json([
                'status_code' => 0,
                'data'        => $data
                ]);
        } catch (PDOException $e) {
            return response()->json([
                'status_code' => 1,
                'message'     => "Failed to get list of blood group."
                ]);
        }

    }

    public function getDistricts()
    {
        try {
            $districts = new DistrictModel();
            $data      = $districts->all();
            return response()->json([
                'status_code' => 0,
                'data'        => $data
                ]);
        } catch (Exception $ex) {
            return response()->json([
                'status_code' => 1,
                'message'     => "Failed to get list of districts."
                ]);
            return $ex->getMessage();
        }

    }


    public function activateStatus(Request $request)
    {
        // if (!JWTAuth::parseToken()->authenticate()) {
        //     return response()->json(['error' => 'Token invalid']);
        // }
        $user        = JWTAuth::parseToken()->toUser();
        $userProfile = new UserProfileModel();
        $status = $userProfile->select('status')->where('user_id', $user->id)->get();
        
        try {
            if($status[0]->status == NULL){

            }
            if ($status[0]->status == 0) {
                return response()->json([
                    'status_code' => 0,
                    'message'     => "You are already active in our system for donating blood"
                    ]);

            } elseif ($userProfile->where('user_id', $user->id)->update(['status' => 0])) {
                return response()->json([
                    'status_code' => 0,
                    'message'     => 'Thank you for updating your status. We will give you informations about any blood donation requirements.'
                    ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'status_code' => 1,
                'message'     => "Sorry ! Couldnot make your status active. Please Try Again."
                ]);
        }
    }

    public function deactivateStatus(Request $request)
    {
        // if (!JWTAuth::parseToken()->authenticate()) {
        //     return response()->json(['error' => 'Token invalid']);
        // }
        $user        = JWTAuth::parseToken()->toUser();
        $id          = $user->id;
        $userProfile = new UserProfileModel();

        $status = $userProfile->select('status')->where('user_id', $user->id)->get();
        try {
            if ($status[0]->status == 1) {
                return $this->apiResponse('success',"You are already inactive in our system for donating blood");
            } elseif ($userProfile->where('user_id', $user->id)->update(['status' => 1])) {
                return $this->apiResponse('success','Take your time. :)');
            }
        } catch (Exception $ex) {
            return $this->apiResponse('failed',"Sorry! Could not made your status deactive. Please Try again");
        }

    }

    public function logout(Request $request)
    {
        // if (!JWTAuth::parseToken()->authenticate()) {
        //     return $this->apiResponse('failed','Token invalid');
        // }

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

     /**
     * [ To send well formatted api response ]
     * @param  [ String ] $type    [ "success" / "failed" ]
     * @param  [ String ] $message [ Message to be send with response. ]
     * @return [json object]          
     */
    function apiResponse($type,$message){
        if($type == 'success'){
            $status_code = 0;
        }elseif ($type == 'failed') {
            $status_code = rand(1,4);
        }
        return response()->json([
            'status_code' => $status_code,
            'message'     => $message
            ]);
    }
}
