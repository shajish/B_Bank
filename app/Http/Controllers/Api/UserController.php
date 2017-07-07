<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User                as UserModel;
use App\Models\RoleUsers    as RoleModel;
use App\Models\UserProfiles as UserProfileModel;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction($request);

        $date             = date('Y-m-d H:i:s');
        try {
           $user_id = DB::table('users')->insertGetId([
            'email'      => $request['email'],
            'username'   => $request['username'],
            'password'   => $request['password'],
            'created_at' => $date
            ]);

           DB::table('role_users')->insert([
             'user_id' => $user_id,'role' => 1
                // 1 : normal user  , 0: admin
            ]);

           DB::table('user_profiles')->insert([
            'user_id'        => $user_id,
            'blood_group_id' => $request['blood_group_id'],
            'name'           => $request['name'],
            'address1'       => $request['district_id'],
            'address2'       => $request['address2'],
            'contacts'       => $request['contacts'],
            'status'         => 1
            ]);
           if(DB::commit()){
               return apiResponse('success','Registration successful'); 
           }else{
            return apiResponse('success','Couldnot register.'); 
        }

    } catch (PDOException $e) {
        DB::rollback();
        throw $e;
        return apiResponse('failed',$e);
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
            return apiResponse('success',$data);
        } else {
            return apiResponse('failed',"failed to get list of users of the group");
        }
    }else{
        return apiResponse('failed',"No data found.");
    }
} catch (PDOException $e) {
    return apiResponse('failed',"failed to get list of users of the group");
}
}
}
