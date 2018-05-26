<?php

//Route::any('/install', 'Api\TelegramController@installMadelineProto');
//
Route::any('/feed', 'Api\TelegramController@parsePosts');

Route::any('/{any}', 'SpaController@index')->where('any', '.*');

