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

// RESTful controllers
Route::controller('users', 'UserController');
Route::controller('fixrequests', 'FixRequestController');
Route::controller('comments', 'CommentController');
Route::controller('directfixrequests', 'DirectFixRequestController');
Route::controller('fixoffers', 'FixOfferController');
Route::controller('notifiables', 'NotifiableController');
Route::controller('posts', 'PostController');
Route::controller('promotionpages', 'PromotionPageController');

//this one to handle standard methods in controller
Route::resource('users', 'UserController');


// Home page
Route::get('/', function(){
    return View::make('home');
});
