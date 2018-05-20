<?php

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/telegram/posts/', 'Api\FeedController@telegramPosts');
});

Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => 'jwt.guest'], function () {
        Route::post('login', 'Api\Auth\LoginController@login');
        Route::post('register', 'Api\Auth\RegisterController@register');
        Route::post('register/validate/login', 'Api\Auth\RegisterController@validateLogin');
    });

    Route::group(['middleware' => ['jwt.refresh', 'jwt.auth']], function () {
        Route::get('refresh', 'Api\Auth\AuthController@refresh');
    });

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('me', 'Api\Auth\AuthController@me');
        Route::post('logout', 'Api\Auth\AuthController@logout');
    });
});

Route::group(['middleware' => ['jwt.auth']], function () {
    Route::post('telegram_channel', 'Api\TelegramController@store');
});