<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/generate/models', '\\Jimbolino\\Laravel\\ModelBuilder\\ModelGenerator5@start');

Route::get('/', function () {
    // $user=new App\User();
    // print_r( $user->where('username','test')->get());
    // return "test";
   return view('welcome');
});
/*

Auth::routes();

Route::get('/home', 'HomeController@index');*/
