<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Dingo\Api\Exception\ValidationHttpException;
use DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayNotifications()
    {
    	try {
           $data =  DB::table('notifications');
            if($data->count() > 0){
                $data->get();
                return apiResponse('success','',$data->get());
            }else{
                return apiResponse('failed','There are no notifications to display');
            }
    	} catch (Exception $e) {
    		return apiResponse('failed','Failed to fetch notification informations');
    	}
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'title'          => 'required',
    		'details'        => 'required',
    		'required_date'  => 'required', // emergency_id
    		'urgency_status' => 'required', // emergency_status_id
    		]);
    	if ($validator->fails()) {
    		throw new ValidationHttpException($validator->errors()->all());;
    	}  

    	$user_token = $request->token;
    	$user       = JWTAuth::toUser($user_token);
    	try {
    		DB::table('notifications')->insert([
    			'user_id'             => $user->id,
    			'title'               => $request->title,
    			'details'             => $request->details,
    			'emergency_date'      => $request->required_date,
    			'emergency_status_id' => $request->urgency_status,
    			'created_at'          => date('Y-m-d H:i:s')
    			]);
    		return apiResponse('success','Your information is successfully recorded.');
    	} catch (Exception $e) {
    		return apiResponse('failed','Couldnot add the information.');
    	}
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateNotification(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'notification_id' => 'required',
    		'title'           => 'required',
    		'details'         => 'required',
    		'required_date'   => 'required', // emergency_id
    		'urgency_status'  => 'required', // emergency_status_id
    		]);
    	if ($validator->fails()) {
    		throw new ValidationHttpException($validator->errors()->all());;
    	}  

    	$user_token = $request->token;
    	$user       = JWTAuth::toUser($user_token);
    	try {
    		$notificationTable = DB::table('notifications')->where('user_id',$user->id)->where('id',$request['notification_id']);
    		
    		if($notificationTable->count() > 0){
    			$notificationTable->update([
    				'user_id'             => $user->id,
    				'title'               => $request->title,
    				'details'             => $request->details,
    				'emergency_date'      => $request->required_date,
    				'emergency_status_id' => $request->urgency_status,
    				'updated_at'          => date('Y-m-d H:i:s')
    				]);
    			return apiResponse('success','The information is updated successfully.');
    		}else{
    			return apiResponse('failed','There is no such notification.');
    		}
    		
    	} catch (Exception $e) {
    		return apiResponse('failed','Couldnot update the notification information.');
    	}
    }
 
}
