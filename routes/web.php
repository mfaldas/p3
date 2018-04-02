<?php

/**
 * web.php
 * Routes file.
 * Created by: Marc-Eli Faldas
 * Last Modified: 4/2/2018
 */

//Displays the Form
Route::get('/', 'PageController@index');

//Processes the Form
Route::get('/calculation', 'PageController@calculation');


