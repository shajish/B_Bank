<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Dingo\Api\Exception\ValidationHttpException;
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
        
        try {
            DB::transaction(function () use ($request) {
                $date             = date('Y-m-d H:i:s');
                $user             = new UserModel();
                
                $user ->username   = $request->get('username');
                $user ->email      = $request->get('email');
                $user ->password   = bcrypt($request->get('password'));
                $user ->created_at = Carbon::now();
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
                $userProfile->status         = 1; // Not available
                $userProfile->save();
            });
            return apiResponse('success','Registration success');
        } catch (Exception $ex) {
            return apiResponse('failed',"Registration failed!! Error: ");
           
        }
    }

	/**
     * [get list of users]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getUser(Request $request)
    {
        try {
           $query= DB::table('users')
           ->join('user_profiles','users.id','=','user_id')
           ->join('districts','districts.id','=','user_profiles.address1')
           ->join('blood_groups','blood_groups.id','=','user_profiles.blood_group_id')
           ->select( 'users.id', 'users.username', 'user_profiles.name','blood_groups.name as blood_group', 'email', 'districts.name as address1','address2','contacts','status' );
         //->where('user_profiles.blood_group_id',$request->blood_group_id);


           if (isset($request->district_id)) {
            $query->where('user_profiles.address1',$request->district_id);
        }
        if($query->count() > 0 ){
            $data = $query->get();
            if ($data[0]->id) {
                return apiResponse('success','',$data);
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
