<?php


Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => 'jwt.guest'], function () {
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




Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('telegram_channel', 'Api\TelegramController@store');
});