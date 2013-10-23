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
        return View::make('users.index', array('users' => $users));
    }

    public function getLogin() {

        $user = Auth::user();
        if (!empty($user->id)) {
            return Redirect::to('/');
        }

        return View::make("users.login");
    }

    public function postLogin() {

        $data = [];

        $credentials = [
            "username" => Input::get("username"),
            "password" => Input::get("password")
        ];
        if (Auth::attempt($credentials)) {
            return Redirect::to("users/profile");
        }

        return View::make("users.login", $data);
    }
    
    /**
     * Show the profile for the current user.
     */
    public function getProfile() {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            return View::make('users.profile', array('user' => $user));
        } else {
            Session::flash('error', 'You do not have permissions to access this content!');
            return View::make('users.login');
        }
    }
    
    /**
     * Log the user out of the application.
     *
     */
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('/');
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

    

}