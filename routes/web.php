<?php

Route::any('/{any}', 'SpaController@index')->where('any', '.*');

