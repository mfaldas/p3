<?php

Route::get('/', 'PageController@welcomePage');

Route::get('/error', 'PageController@errorPage');

Route::get('/calculation', 'PageController@calculatedPage');

