<?php

Route::middleware('auth:api')->namespace('Admin')->group(function () {

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index');
    });

    Route::prefix('permissions')->group(function () {
        Route::post('create', 'PermissionController@create');
    });

    Route::prefix('roles')->group(function () {
        Route::post('create', 'RoleController@create');
    });
});

// TODO: Routes Auth
Route::post('signin', 'Auth\AuthController@signin');
Route::get('signup/activate/{token}', 'Auth\AuthController@signupActivate');
Route::post('users/create', 'Admin\UserController@create');

Route::middleware('auth:api')->namespace('Auth')->group(function () {
        Route::post('signout', 'AuthController@signout');
});
