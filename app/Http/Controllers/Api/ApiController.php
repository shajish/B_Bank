<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Category as CategoryModel;
use App\User as UserModel;
use App\Models\RoleUsers as RoleModel;
use App\Models\UserProfiles as UserProfileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Dingo\Api\Exception\ValidationHttpException;

class ApiController extends Controller
{

    public function registerUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'name' => 'required',
            'email' => 'required',
            'location' => 'required',
            'contacts' => 'required',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        DB::transaction(function () use ($request) {
            $date = date('Y-m-d H:i:s');
            $user = new UserModel();
            $user->username = $request['username'];
            $user->password = $request['password'];
            $user->created_at = $date;
            $user->save();
//
            $user_id = $user->id;

            $role = new RoleModel();//DB::table('role_users');
            $role->user_id = $user_id;
            $role->role = 1;//$request['role'];
            $role->save();

            $userProfile = new UserProfileModel();
            $userProfile->user_id = $user_id;
            $userProfile->name = $request['name'];
            $userProfile->email = $request['email'];
            $userProfile->location = $request['location'];
            $userProfile->contacts = $request['contacts'];
            $userProfile->category_id = $request['category_id'];
            $userProfile->status = 0;
            $userProfile->save();
        });
        return json_encode('registration success');
    }
    /* api for-> fetching out blood group*/
    public function getBloodGroup()
    {

        try {
            $category = new CategoryModel();
            $data = $category->all();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return json_encode($data);
    }

    public function getUser(Request $request)
    {
        if (!JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'Token invalid']);
        }

//        return $request->category_id;
        $validator = Validator::make($request->all(), [
            'category_id' => 'required'
        ]);
        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }
        try {
            $userprofile = new UserProfileModel();
            $data = $userprofile->where('category_id', $request->category_id)->get();
            if ($data[0]->id) {
                return json_encode($data);
            } else {
                return response()->json(['message' => "cannot find people of requested group"]);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function activateStatus(Request $request)
    {
        if (!JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'Token invalid']);
        }
        $user = JWTAuth::parseToken()->toUser();
        $userProfile = new UserProfileModel();
//        return $user->id;
        $status= $userProfile->select('status')->where('user_id',$user->id)->get();
        try {
            if($status[0]->status == 0){
                return response()->json(['message'=>"You are already active in our system for donating blood"]);
            }elseif($userProfile->where('user_id', $user->id)->update(['status' => 0])){
                return response()->json(['message'=>'Soon you can donate blood :) ']);
            }
        } catch (Exception $ex) {
            return response()->json(['message'=>"Sorry ! Couldnot make your status active. Please Try Again."]);
        }
    }

    public function deactivateStatus(Request $request)
    {
        if (!JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'Token invalid']);
        }
        $user = JWTAuth::parseToken()->toUser();
        $id=$user->id;
        $userProfile = new UserProfileModel();

        $status= $userProfile->select('status')->where('user_id',$user->id)->get();
        try {
            if($status[0]->status == 1){
                return response()->json(['message'=>"You are already active in our system for donating blood"]);
            }elseif($userProfile->where('user_id', $user->id)->update(['status' => 1])){
                return response()->json(['message'=>'Take your time. :)' ]);
            }
        } catch (Exception $ex) {
            return response()->json(['message'=>"Sorry! Could not made your status deactive. Please Try again"]);
        }

/*
        if($userProfile->where('user_id', $user->id)->update(['status' => 1])){
            return "Take your time. :) ";
        }else{
            return "Sorry! Could not made your status deactive. Please Try again";
        }*/
    }

}



