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
Route::model('fixrequests', 'FixRequest');
Route::model('comments', 'Comment');
Route::model('directfixrequests', 'DirectFixRequest');
Route::model('fixoffers', 'FixOffer');
Route::model('notifiables', 'Notifiable');
Route::model('posts', 'Post');
Route::model('promotionpages', 'PromotionPage');


/** ------------------------------------------
 *  Routes which requires authentication
 *  ------------------------------------------
 */

Route::post('users/reset-pass','UserController@postResetPass');
Route::get('users/codetoresetpass',array('uses'=>'UserController@getCodeToResetPass'));
Route::group(array("before" => "auth"), function()
{
    # User Management    
    Route::get('users/confirmation','UserController@getConfirmation');
    Route::get('users/logout', 'UserController@getLogout');
    Route::get('users/index', 'UserController@getIndex');
    Route::get('users/profile','UserController@getProfile');
    Route::get('users/confirm-user', 'UserController@getConfirmUser');
    Route::get('users/edit', 'UserController@getEdit');
    Route::post('users/edit', 'UserController@postEdit');

    # Fix Requests management
    // Route::get('fixrequests/create', 'FixRequestController@getCreate');
    // Route::get('fixrequests/create', 'FixRequestController@postCreate');
});

/** ------------------------------------------
 *  Public routes
 *  ------------------------------------------
 */
# RESTful Routes
Route::controller('users', 'UserController');
Route::controller('fixrequests', 'FixRequestController');
Route::controller('comments', 'CommentController');
Route::controller('directfixrequests', 'DirectFixRequestController');
Route::controller('fixoffers', 'FixOfferController');
Route::controller('notifiables', 'NotifiableController');
Route::controller('posts', 'PostController');
Route::controller('promotionpages', 'PromotionPageController');

// Home page
Route::get('/', function() {
    return View::make('home');
});



