<?php

use Illuminate\Http\Request;
use \Tymon\JWTAuth\Facades\JWTAuth;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    $api = app('Dingo\Api\Routing\Router');

    $api->version('v1', ['namespace' => "App\Http\Controllers\Api"], function ($api) {

        /*--Authorized token not requried--*/
        $api->post('login', ['uses' => 'AuthController@login']);
        $api->post('register', ['uses' => 'UserController@registerUser']);

        $api->get('bgroups', ['uses' => 'ApiController@getBloodGroup']);
        $api->get('districts', ['uses' => 'ApiController@getDistricts']);

        /*--Authorized token required--*/

        $api->post('userlist', ['uses' => 'UserController@getUser'])->middleware('jwt-auth');
        $api->get('activate', ['uses' => 'ApiController@activateStatus']);
        $api->get('deactivate', ['uses' => 'ApiController@deactivateStatus']);
        $api->get('logout', ['uses' => 'ApiController@logout']);

    });
