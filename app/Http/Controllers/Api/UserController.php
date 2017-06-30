<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User                as UserModel;
use App\Models\RoleUsers    as RoleModel;
use App\Models\UserProfiles as UserProfileModel;
use App\Http\Controllers\Api\ApiController;

class UserController extends Controller
{
    public function registerUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username'       => 'required',
            'email'          => 'required',
            'password'       => 'required',
            'blood_group_id' => 'required',
            'name'           => 'required',
            'district_id'    => 'required',
            'address2'       => 'required',
            'contacts'       => 'required',
            ]);

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }
        try {
            DB::transaction(function () use ($request) {
                $date             = date('Y-m-d H:i:s');
                $user             = new UserModel();
                $user ->username   = $request['username'];
                $user ->email      = $request['email'];
                $user ->password   = $request['password'];
                $user ->created_at = $date;
                $user ->save();
                $user_id          = $user->id;

                $role          = new RoleModel();
                $role->user_id = $user_id;
                // 1 : normal user  , 0: admin
                $role->role    = 1;
                $role->save();

                $userProfile                 = new UserProfileModel();
                $userProfile->user_id        = $user_id;
                $userProfile->blood_group_id = $request['blood_group_id'];
                $userProfile->name           = $request['name'];
                $userProfile->address1       = $request['district_id'];
                $userProfile->address2       = $request['address2'];
                $userProfile->contacts       = $request['contacts'];
                    $userprofile->status         = 1; // Not available
                    $userProfile->save();
                });
            return response()->json([
                'status_code' => 0,
                'message'     => 'Registration success'
                ]);
        } catch (Exception $ex) {
            return response()->json([
                "status_code" => 1,
                "message"     => "Registration failed"
                ]);
        }
    }

    public function getUser(Request $request)
    {
    	$apiControllerObject = new ApiController();
        $validator = Validator::make($request->all(), [
            'blood_group_id' => 'required',
            ]);
        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }
        try {
            $userprofile = UserProfileModel::query();
            $userprofile = $userprofile->where('blood_group_id', $request->blood_group_id)->where('status',0);
            
            if (isset($request->district_id)) {
                $userprofile = $userprofile->where('address1', $request->district_id);
            }
            if($userprofile->count() > 0 ){
                $data = $userprofile->get();
                if ($data[0]->id) {
                    return $apiControllerObject->apiResponse('success',$data);
                } else {
                    return $apiControllerObject->apiResponse('failed',"failed to get list of users of the group");
                }
            }else{
                return $apiControllerObject->apiResponse('failed',"No data found.");
            }
        } catch (PDOException $e) {
            return $apiControllerObject->apiResponse('failed',"failed to get list of users of the group");
        }
    }
}
