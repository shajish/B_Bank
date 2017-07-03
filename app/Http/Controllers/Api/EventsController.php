<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\Api\ApiController;
use App\Models\Events    as EventModel;

class EventsController extends Controller
{
	public function addEvents(Request $request){
			return apiResponse('failed','Testing a service provider.');
			die();
		$validator = Validator::make($request->all(), [
			'title'    => 'required',
			'details'  => 'required',
			'location' => 'required',
			'date'     => 'required',
			'duration' => 'required',
			]);
		if ($validator->fails()) {
			throw new ValidationHttpException($validator->errors()->all());
		}
		
		$apiControllerObject = new ApiController();

		try {
			$user_token = $request->token;
			$user = JWTAuth::toUser($user_token);
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

		} catch (Exception $e) {
			return $apiControllerObject->apiResponse('failed','Failed to add event.');
		}
	}


	public function getEvents(){

	}
}
