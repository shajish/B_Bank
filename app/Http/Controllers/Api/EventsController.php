<?php

namespace App\Http\Controllers\Api;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Support\Facades\DB;

use App\Models\Events as EventModel;

class EventsController extends Controller
{
    public function addEvents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'details'   => 'required',
            'location'  => 'required',
            'date'      => 'required',
            'duration'  => 'required',
            ]);
        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());;
        }
        try {
            $user_token = $request->token;
            $user = JWTAuth::toUser($user_token);
            DB::transaction(function () use ($request,$user) {
                $event           = new EventModel();
                $event->title    = $request['title'];
                $event->details  = $request['details'];
                $event->location = $request['location'];
                $event->date     = $request['date'];
                $event->duration = $request['duration'];
                $event->status = 0 ;// active
                $event->remark = 'Upcoming';
                $event->user_id  = $user->id;
                $event->save();
            });
            return apiResponse('success','Successfully added an event.');

        } catch (Exception $e) {
            return apiResponse('failed', 'Failed to add event.');
        }
    }



    public function changeStatus(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'event_id'     => 'required',
                'new_remark'    => 'required',
                'action'    =>'required'
                ]);
            if ($validator->fails()) {
                throw new ValidationHttpException($validator->errors()->all());;
            }
            if($request['action'] == 'activate'){
                $changeStatusTo = 0;
            }elseif($request['action'] == 'deactivate'){
                $changeStatusTo = 1;
            }

            $user = JWTAuth::toUser($request->token);
            $events= new EventModel();
            $eventData = $events->where('id',$request['event_id'])->where('user_id',$user->id);
            $eventCount = $eventData->count();
            if($eventCount == 0){
                return apiResponse('failed','There is no event to perform this action.');
            }else{
                $eventStatus = $eventData->pluck('status');
                $eventRemark = $eventData->pluck('remark');
                if($eventStatus[0] == $changeStatusTo && $eventRemark[0] == $request['remark']){
                    return apiResponse('success','Already in that state');
                }elseif ($eventStatus[0] == $changeStatusTo) {
                    $eventData->update(['remark' => $request['new_remark']]);
                }else{
                    $eventData->update([
                        'remark' => $request['new_remark'],
                        'status' => $changeStatusTo
                        ]);
                }

                return apiResponse('success','Event status updated');
            }
    } catch (Exception $e) {
       return apiResponse('failed', 'Failed to add event.');
   }
}


public function getEvents()
{
    try {
        $events = new EventModel();
        $allEvents= $events->where('status',0)->get();    

        return apiResponse('success','',$allEvents);
    } catch (Exception $e) {
        return apiResponse('failed', 'Failed to get events.');
    }
}
}
