<?php

use Illuminate\Http\Request;


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('register', 'Api\AuthController@register');
    Route::post('login', 'Api\AuthController@login');
});