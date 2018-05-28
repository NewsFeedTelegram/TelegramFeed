<?php

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/telegram/posts/', 'Api\FeedController@telegramPosts');

    Route::get('/telegram/channel', 'Api\TelegramController@getChannels');
    Route::post('/telegram/channel', 'Api\TelegramController@saveChannel');
    Route::delete('/telegram/channel/{id}', 'Api\TelegramController@deleteChannel');
});

Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => 'jwt.guest'], function () {
        Route::post('login', 'Api\Auth\LoginController@login');
        Route::post('register', 'Api\Auth\RegisterController@register');
        Route::get('register/validate/login', 'Api\Auth\RegisterController@validateLogin');
    });
    Route::group(['middleware' => ['jwt.refresh']], function () {
        Route::post('refresh', 'Api\Auth\AuthController@refresh');
    });
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('me', 'Api\Auth\AuthController@me');
        Route::post('logout', 'Api\Auth\AuthController@logout');
    });
});

