<?php

//Route::any('/install', 'Api\TelegramController@installMadelineProto');

Route::any('/telegram', 'Api\FeedController@telegram');

Route::any('/feed', 'Api\TelegramController@parsePosts');

Route::any('/{any}', 'SpaController@index')->where('any', '.*');

