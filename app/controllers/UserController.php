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
    public function getIndex() {
        $users = User::all();
        return View::make('users.index', array('users' => $users));
    }

    public function getLogin() {        
        return View::make("users.login");        
    }

    public function postLogin() {

        $validator = Validator::make(Input::all(), $this->loginRules);

        if ($validator->passes()) {
            $credentials = array(
                "username" => Input::get("username"),
                "password" => Input::get("password")
            );
            if (Auth::attempt($credentials)) {                
                return Redirect::to("users/profile");
            }
        }

        

        return Redirect::to('users/login')
                        ->withInput()
                        ->withErrors($validator);
        //var_dump($error = $validator->errors()->all());
    }

    /**
     * Show the profile for the current user.
     */
    public function getProfile() {
        $user = User::find(Auth::user()->id);
        return View::make('users.profile', array('user' => $user));
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
     * Show the form for editing user.
     *
     * @return Response
     */
    public function getEdit() {
        $user = Auth::user();
        return View::make('users.edit', compact('user'));
    }

    /**
     * Show the form for editing user.
     *
     * @return Response
     */
    public function postEdit() {
        var_dump(Input::all());
        die;
    }

    /**
     * Show the form for editing user.
     *
     * @return Response
     */
    public function getConfirmUser() {

        $msg = 'An email with confirmation procedure was successfully sent to <b>' . Auth::user()->email . '</b>.
            <br/>Please follow the instructions in the email to confirm the user!';

        Session::flash('success', $msg);
        return View::make('users.profile');
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
            $user->confirmation_code = str_replace("/","",Hash::make(Input::get('email')));

            $user->save();
            Auth::login($user);

            //var_dump($user)
            Email::sendConfirmationEmail($user->email, $user->username, $user->confirmation_code);

            return Redirect::to("users/profile");
        }
    }

    public function getConfirmation($code) {
        $user = User::whereRaw('confirmation_code = ?', array($code))->get();
        
        if($user[0] != null && $user[0]->id == Auth::user()->id)
        {
            //$user[0]->confirmed = 1;
            User::where('confirmation_code', $code)->update(array('confirmed' => 1));
        }

        return Redirect::to("users/profile");
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

    public function getFb()
    {
        $facebook = new Facebook(Config::get('facebook'));
        $params = array(
            'redirect_uri' => url('users/fb-callback'),
            'scope' => 'email'
            );
        return Redirect::to($facebook->getLoginUrl($params));
    }

    public function getFbCallback()
    {
        $code = Input::get('code');

        if(strlen($code) == 0) {
            return Redirect::to('users/login')->with('message', 'There was an error communicating with Facebook');
        }

        $facebook = new Facebook(Config::get('facebook'));
        $uid = $facebook->getUser();

        if($uid == 0) {
            return Redirect::to('users/login')->with('message', 'There was an error');
        }

        $me = $facebook->api('/me');

        $profile = Profile::whereUid($uid)->first();
        if(empty($profile)) {
            $user = new User;
            $user->email = $me['email'];
            $user->username = $me['username'];
            $user->save();

            $profile = new Profile();
            $profile->uid = $uid;
            $profile->username = $me['username'];
            $profile = $user->profiles()->save($profile);
        }

        $profile->access_token = $facebook->getAccessToken();
        $profile->save();

        $user = $profile->user;

        Auth::login($user);

        return Redirect::to('users/profile')->with('message', "Logged in with Facebook");
    }
}