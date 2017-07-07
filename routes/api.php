<?php

use Illuminate\Http\Request;
use \Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => "App\Http\Controllers\Api"], function ($api) {

    /*--Authorized token not requried--*/
    $api->post('login', ['uses' => 'AuthController@login']);
    $api->post('register', ['uses' => 'UserController@registerUser']);

    $api->get('bgroups', ['uses' => 'ApiController@getBloodGroup']);
    $api->get('districts', ['uses' => 'ApiController@getDistricts']);

    /*--Authorized token required--*/
    $api->post('userList', ['uses' => 'UserController@getUser'])->middleware('jwt-auth');
    $api->post('addEvents',['uses' => 'EventsController@addEvents'])->middleware('jwt-auth');
    $api->post('changeEventStatus',['uses' => 'EventsController@changeStatus'])->middleware('jwt-auth');
    $api->post('addNotification',['uses' => 'NotificationController@store'])->middleware('jwt-auth');
    $api->post('updateNotification',['uses' => 'NotificationController@updateNotification'])->middleware('jwt-auth');


    $api->get('activate'   , ['uses'   => 'ApiController@activateStatus'  ] );
    $api->get('deactivate' , ['uses' => 'ApiController@deactivateStatus'  ] );
    $api->get('logout'     , ['uses'     => 'ApiController@logout'        ] );
    $api->get('getEvents'     , ['uses'      => 'EventsController@getEvents' ] );
    $api->get('getNotifications'     , ['uses'      => 'NotificationController@displayNotifications' ] );



});
