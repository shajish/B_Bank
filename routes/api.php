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
        $api->post('userlist', ['uses' => 'ApiController@getUser']);
        $api->get('active', ['uses' => 'ApiController@activateStatus']);
        $api->get('notactive', ['uses' => 'ApiController@deactivateStatus']);
        $api->get('logout', ['uses' => 'ApiController@logout']);

    });
