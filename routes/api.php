<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'auth'], function () {
    Route::grope(['middleware' => 'jwt.guest'], function () {
        Route::post('register', 'Api\AuthController@register');
        Route::post('login', 'Api\AuthController@login');
    });

    Route::group(['middleware' => 'jwt.refresh'], function () {
        Route::get('refresh', 'Api\AuthController@refresh');
    });
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('me', 'Api\AuthController@me');
        Route::post('logout', 'Api\AuthController@logout');
    });
});