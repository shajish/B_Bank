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

$api->version('v1',['namespace'=>"App\Http\Controllers\Api"], function ($api) {

    $api->any('login',['uses' => 'AuthController@Login']);
    $api->any('BGroups',['uses' => 'ApiController@getBloodGroup']);
    $api->any('Userlist',['uses' => 'ApiController@getUser']);
    $api->any('register',['uses' => 'ApiController@registerUser']);
    $api->any('active',['uses' => 'ApiController@activateStatus']);
    $api->any('notactive',['uses' => 'ApiController@deactivateStatus']);

});
