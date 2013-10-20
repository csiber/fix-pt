<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/** ------------------------------------------
 *  Route model binding
 *  - for each model add one entry
 *  ------------------------------------------
 */
Route::model('users', 'User');


//this one to handle custom methods in controller
Route::controller('users', 'UserController');

//this one to handle standard methods in controller
Route::resource('users', 'UserController');

Route::resource('photos', 'PhotoController');


/*HOME PAGE ROUTE*/
Route::get('/', 'HomeController@showWelcome');


/* TEMPORARY ROUTES --> */

Route::get('fix-requests/create', function(){
    return View::make('fix-requests/create');
});

Route::get('fix-requests/list', function(){
    return View::make('fix-requests/list');
});

/* <-- TEMPORARY ROUTES */
