<?php

Route::get('/', 'PageController@welcomePage');
Route::get('/show', 'PageController@show');

Route::get('/error', 'PageController@errorPage');
Route::get('/{calculation}', 'PageController@calculationPage');
