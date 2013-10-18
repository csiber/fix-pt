<?php

class UserController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    /**
     * Index displays all users of the system
     * @return Response
     */
    public function index() {

        $users = User::all();
        return View::make('users.index', array('usersArray' => $users));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create() {
        
    }

    public function show($id) {
        $user = User::find(1);

        return View::make('users.show', array('data' => array(
                        'userArray' => $user,
                        'id' => $id
        )));
    }

    public function getShowUser($id) {
        $user = User::find(1);

        return View::make('users.show-user', array('dataUser' => array(
                        'userArray' => $user,
                        'id' => $id
        )));
    }

    /**
     * Show the profile for the given user.
     */
    public function getProfile($id) {
        $user = User::find($id);

        return View::make('users.profile', array('user' => $user));
    }

}