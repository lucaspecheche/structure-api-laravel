<?php

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

Route::prefix('users')->namespace('Admin')->group(function (){
    Route::post('create', 'UserController@create');
});

Route::post('signin', 'Auth\AuthController@signin');

Route::middleware('auth:api')->namespace('Auth')->group(function () {
        Route::post('signout', 'AuthController@signout');
        Route::get('teste', 'AuthController@teste');
});

