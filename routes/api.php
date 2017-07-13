<?php

use Illuminate\Http\Request;
use \Tymon\JWTAuth\Facades\JWTAuth;

$api = app('Dingo\Api\Routing\Router');

    /**
     * { Authorized token not requried }
     */
    $api->version('v1',['namespace' => "App\Http\Controllers\Api"],function($api){
        $api -> post('login'       , ['uses' => 'AuthController@login'        ] );
        $api -> post('register'    , ['uses' => 'UserController@registerUser' ] );

        $api -> get('bloodGroups'  , ['uses' => 'ApiController@getBloodGroup' ] );
        $api -> get('districts'    , ['uses' => 'ApiController@getDistricts'  ] );

        $api -> get('refreshToken' , ['uses' => 'ApiController@refreshToken'  ] );
    });

    /**
     * { Authorized token required }
     */
    $api->version('v1', ['namespace' => "App\Http\Controllers\Api", 'middleware' => 'jwt-auth'], function ($api) {
        $api->post('userList'           , ['uses' => 'UserController@getUser'                    ] );
        $api->post('addEvents'          , ['uses' => 'EventsController@addEvents'                ] );
        $api->post('changeEventStatus'  , ['uses' => 'EventsController@changeStatus'             ] );
        $api->post('addNotification'    , ['uses' => 'NotificationController@store'              ] );
        $api->post('updateNotification' , ['uses' => 'NotificationController@updateNotification' ] );

        $api->get('activate'         , ['uses' => 'ApiController@activateStatus'                ] );
        $api->get('deactivate'       , ['uses' => 'ApiController@deactivateStatus'              ] );
        $api->get('logout'           , ['uses' => 'AuthController@logout'                       ] );
        $api->get('getEvents'        , ['uses' => 'EventsController@getEvents'                  ] );
        $api->get('getNotifications' , ['uses' => 'NotificationController@displayNotifications' ] );
    });
