<?php

class UserController extends BaseController {

    public $rules = array(
        'username' => 'required|alpha_dash|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|between:4,11',
        'confirm_password' => 'same:password',
    );
    public $loginRules = array(
        'username' => 'required',
        'password' => 'required',
    );

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

        $validator = Validator::make(Input::all(), $this->loginRules);

        if ($validator->passes()) {
            $credentials = [
                "username" => Input::get("username"),
                "password" => Input::get("password")
            ];
            if (Auth::attempt($credentials)) {                
                return Redirect::to("users/profile");
            }
        }
        Mail::send('emails.auth.testmail', array('id'=>1), function($message)
            {
                $message->to('ei10108@fe.up.pt', 'ei10108')->subject('Welcome!');
            });
        return Redirect::to('users/login')
                        ->withInput()
                        ->withErrors($validator);
        //var_dump($error = $validator->errors()->all());
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
    public function getLogout() {
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function getCreate() {
        return View::make('users.create');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function postCreate() {

        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {
            return Redirect::to('users/create')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            $user = new User;
            $user->email = Input::get('email');
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            Auth::login($user);

            

            return Redirect::to("users/profile");
        }
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