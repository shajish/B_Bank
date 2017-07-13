<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Dingo\Api\Exception\ValidationHttpException;
use App\Models\BloodGroups as BloodGroupModel;
use App\User as UserModel;
use App\Models\RoleUsers as RoleModel;
use App\Models\Districts as DistrictModel;
use App\Models\UserProfiles as UserProfileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ApiController extends Controller
{

    /**
     * Gets the blood group.
     * @return     < json >  The blood group.
     */
    public function getBloodGroup()
    {
        try {
            $category = new BloodGroupModel();
            $data     = $category->all();
            return apiResponse('success','',$data);
        } catch (PDOException $e) {
            return apiResponse('failed','Failed to get list of blood group.');
        }
    }

    /**
     * Gets the districts.
     * @return     <json api>  The districts.
     */
    public function getDistricts()
    {
        try {
            $districts = new DistrictModel();
            $data      = $districts->all();
            return apiResponse('success','',$data);
        } catch (Exception $ex) {
            return apiResponse('failed',"Failed to get list of districts.");
        }
    }


    public function activateStatus(Request $request)
    {
        $user        = JWTAuth::parseToken()->toUser();
        $userProfile = new UserProfileModel();
        $status = $userProfile->select('status')->where('user_id', $user->id)->get();
        
        try {
            if($status[0]->status == NULL){

            }
            if ($status[0]->status == 0) {
                return apiResponse('success','You are already active in our system for donating blood');
            } elseif ($userProfile->where('user_id', $user->id)->update(['status' => 0])) {
                return apiResponse('success','Thank you for updating your status. We will give you informations about any blood donation requirements.');
            }
        } catch (Exception $ex) {
            return apiResponse('failed','Sorry ! Couldnot make your status active. Please Try Again.');
        }
    }

    /**
     * { Deactivate the user availability }
     * @param      \Illuminate\Http\Request  $request  The request
     * @return     < json api >                    
     */
    public function deactivateStatus(Request $request)
    {
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
    
    /**
     * { To refresh the expired token }
     * @param      \Illuminate\Http\Request  $request  The request
     * @return     <json>                    
     */
    public function RefreshToken(Request $request){
        try
        {
            $refreshed = JWTAuth::refresh($request['token']);
            return apiResponse('success','token Refreshed',$refreshed);
        }
        catch (JWTException $e)
        {
            return apiResponse('failed','Token is  not refreshable');
        }
    }

}
