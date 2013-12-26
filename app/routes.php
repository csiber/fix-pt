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
Route::model('search', 'Search');


/** ------------------------------------------
 *  Routes which requires authentication
 *  ------------------------------------------
 */

Route::post('users/reset-pass','UserController@postResetPass');
Route::get('users/codetoresetpass/{code}','UserController@getCodeToResetPass');
Route::post('users/removenotifications','UserController@removeNotifications');
// TODO what is this before => none??
Route::group(array("before" => "none"), function(){
    Route::get('users/confirmation','UserController@getConfirmation');    
});

Route::get('users/favorite/{code}','UserController@addToFavorites');

Route::get('users/removeFav/{code}','UserController@deleteFromFavorites');

Route::get('fixrequests/blockfixrequest/{id}','FixRequestController@blockFixrequest');

Route::group(array("before" => "auth"), function()
{
    # User Management    
    Route::get('users/logout', 'UserController@getLogout');
    Route::get('users/index', 'UserController@getIndex');
    Route::get('users/manage_users', 'UserController@getManage_Users');
    Route::get('users/profile','UserController@getProfile');
    Route::get('users/confirm-user', 'UserController@getConfirmUser');
    Route::get('users/edit', 'UserController@getEdit');
    Route::get('users/reset-password', 'UserController@showChangePassword');
    Route::post('users/edit', 'UserController@postEdit');
    Route::post('users/change_permission','UserController@change_permission');
    Route::get('users/upgrade','UserController@upgrade');
    Route::get('users/downgrade','UserController@downgrade');

    Route::post('comments/create','CommentController@postCreate');
    Route::post('users/manage_users','UserController@postManage_Users');

    Route::post('jobs/create', 'JobController@postCreate');

    // # Fix Requests management
    Route::post('fixrequests/create', 'FixRequestController@postCreate');
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
Route::controller('jobs', 'JobController');
Route::controller('promotionpages', 'PromotionPageController');
Route::post('search/getconcelhos', 'SearchController@getConcelhosList');
Route::controller('search', 'SearchController');

// Home page
Route::get('/', function() {
    $pds = Search::get_distritos();
    $dists = array();
    $dists[""] = "Escolha um distrito";
    foreach($pds as $pd) {
        $dists[$pd->id] = $pd->name;
    }
    return View::make('home', array('dists' => $dists));
});
