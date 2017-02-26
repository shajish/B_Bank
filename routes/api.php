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

        /*=> post*/
        $api->post('login', ['uses' => 'AuthController@Login']);
        $api->post('register', ['uses' => 'ApiController@registerUser']);
        /*=> get*/
        $api->get('bgroups', ['uses' => 'ApiController@getBloodGroup']);
        $api->get('district', ['uses' => 'ApiController@getDistricts']);

        /*--Authorized token required--*/
        $api->any('userlist', ['uses' => 'ApiController@getUser']);
        $api->any('active', ['uses' => 'ApiController@activateStatus']);
        $api->any('notactive', ['uses' => 'ApiController@deactivateStatus']);

    });
