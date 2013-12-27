<?php

class UserController extends BaseController {

    public $rules = array(
        'username' => 'required|alpha_dash|unique:users',
        'email' => 'required|email|unique:users',
        'password' => 'required|between:4,11',
        'confirm_password' => 'same:password'
    );

    public $editRules = array(
        'full_name' => 'required|min:8',
    );
    public $loginRules = array(
        'username' => 'required',
        'password' => 'required',
    );
    public $resetPassRules = array(
        'password' => 'required|between:4,11',
        'confirm_password' => 'same:password'
    );

    /**
     * Index displays all users of the system
     * @return Response
     */
    public function getIndex($users_type = null, $userid = null) {
        if ($users_type == "administrator" || $users_type == "moderator" || $users_type == "premium" || $users_type == "standard") {
            $users = DB::table('users')->where('user_type', '=', $users_type)->get();
        } else {
            $users = User::all();
            $users_type = "all";
        }
        return View::make('users.index', array('users' => $users, 'users_type' => $users_type, 'userid' => $userid));
    }

    /**
     * View displays profile of a given user
     * @return Response
     */
    public function getView($id) {
        if (Auth::check() && $id == Auth::user()->id) {
            return Redirect::to("users/profile");
        }
        $user = User::getUser($id);
        return View::make('users.view', array('user' => $user));
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
                $promotionPage = PromotionPage::isTherePromotionPage();
                Session::put('haspromotionpage', $promotionPage);
                return Redirect::to("users/profile");
            }
        }

        Session::flash('error', 'Invalid username or password.');

        return Redirect::to('users/login')
                        ->withInput()
                        ->withErrors($validator);
        //var_dump($error = $validator->errors()->all());
    }

    public function postResetPass() {

        $email = Input::get('email');
        $user = User::whereRaw('email = ?', array($email))->get();
        $code = $user[0]->confirmation_code;

        Email::sendResetPassEmail($email, $code);
        //echo 'Email sent for reseting the password' ;

        Session::flash('success', 'Email sent for reseting the password.');
        return Redirect::to('/users/login');
    }

    public function getCodeToResetPass($code) {
        $user = User::whereRaw('confirmation_code = ?', array($code))->get();

        if ($user[0] != null) {
            //$user[0]->confirmed = 1;
            //$newPass = Hash::make("Fix.pt");
            //User::where('confirmation_code', $code)->update(array('password' => $newPass));
            Auth::login($user[0]);
        }
        //Session::flash('success', 'Password has been reseted to the default Fix.pt');

        return Redirect::to("/users/reset-password");
    }

    public function showChangePassword() {
        return View::make('users.change-password');
    }

    public function postChangePassword() {
        $user = User::find(Auth::user()->id);

        $validator = Validator::make(Input::all(), $this->resetPassRules);

        if ($validator->fails()) {
            return Redirect::to('users/reset-password')
                            ->withInput()
                            ->withErrors($validator);
        }

        if (/* Hash::make(Input::get('oldPass')) == $user['password'] or */ true /* para tirar depois */) {
            $newPass = Hash::make(Input::get('password'));
            //$user->update(array('password' => $newPass));
            User::where('id', Auth::user()->id)->update(array('password' => $newPass));
            Session::flash('success', 'Password changed successfully.');
            return View::make('users.profile', array('user' => $user));
        } else {
            //erro
            Session::flash('error', 'Wrong Password.');
        }

        //return Redirect::to("/");
    }

    /**
     * Show the profile for the current user.
     */
    public function getProfile($rating_sort="all") {
		
        if($rating_sort == "negative"
            || $rating_sort == "neutral"
            || $rating_sort == "positive"
            || $rating_sort == "all") {
            $ratings = User::getRatings($rating_sort);
        } else {
            return Redirect::to('users/profile/all');
        }

        foreach($ratings as &$rate) {
            // $rate['fixrequest'] = FixRequest::find($rate['fix_request_id']);
            $rate['fixer'] = User::find($rate['fixer_id']);
            $rate['requester'] = User::find($rate['requester_id']);
            $rate['fixer']['gravatar'] = UtilFunctions::gravatar($rate['fixer']->email, 16);
            $rate['requester']['gravatar'] = UtilFunctions::gravatar($rate['requester']->email, 16);
        }

		$lastrates = User::getLast3Ratings(Auth::user()->id);
        foreach($lastrates as &$rate) {
            $rate['requester'] = User::find($rate['requester_id']);
            $rate['requester']['gravatar'] = UtilFunctions::gravatar($rate['requester']->email, 20);
        }
/*      
        $notifications=Notification::getNotificationsOfUser($user['id']);
        UtilFunctions::dump($notifications);
*/
		return View::make('users.profile', array(
            'ratings' => $ratings,
			'lastrates' => $lastrates,
            'sort' => $rating_sort,
            "gravatar" => UtilFunctions::gravatar(Auth::user()->email, 190),
        ));
    }

    /**
     * Show the profile for the current user.
     */
    public function getDashboard($sort=null) {
        $favorites = null;
        $fixrequests = null;

        if($sort == "fixrequests") {
            $fixrequests = FixRequest::requests_from_user()->paginate(5);

            foreach($fixrequests as &$fixrequest) {
                $post = Post::find($fixrequest['post_id']);
                $user = User::find($post['user_id']);
                
                $fixrequest['text'] = UtilFunctions::truncateString(trim(((stripslashes($post->text)))), 220);
                $fixrequest['user_id'] = $post['user_id'];
                $fixrequest['username'] = $user['username'];
                $fixrequest['user_image'] = $user['user_image'];
                $fixrequest['created_at_pretty'] = UtilFunctions::prettyDate($fixrequest['created_at']);
                $fixrequest['category'] = $fixrequest->category;
                $fixrequest['category_class'] = UtilFunctions::getCategoryIdWord($fixrequest->category['id']);

                $fixrequest['end_date_exact'] = date("Y-m-d H:i:s", strtotime($fixrequest->created_at." + $fixrequest->daysForOffer days"));
                $fixrequest['end_date'] = UtilFunctions::getEndDate($fixrequest['created_at'], $fixrequest['daysForOffer']);
                $fixrequest['tags'] = Tag::getTagsOfRequest($fixrequest['id']);
            }

        } else if($sort == "comments") {
            $search = null;
        } else if($sort == "favorites"){
            $favorites = Auth::user()->favorites()->get();
            foreach($favorites as &$favorite) {
                $favorite['user'] = User::find($favorite->user_2);
                $favorite['gravatar'] = UtilFunctions::gravatar($favorite['user']->email, 32);
            }
        } else {
            return Redirect::to('users/dashboard/fixrequests');
        }
        return View::make('users.dashboard', array(
            "sort" => $sort,
            "favorites" => $favorites,
            "fixrequests" => $fixrequests,
        ));
    }

    /**
     * Log the user out of the application.
     *
     */
    public function getLogout() {
        Auth::user()->Last_login = date('Y-m-d h:i:s', time());
        Auth::user()->save();
        Auth::logout();
        return Redirect::to('/');
    }

    /**
     * Show the form for editing user.
     *
     * @return Response
     */
    public function getEdit($id) {
        if ($id == Auth::user()->id || Auth::user()->user_type == 'Administrator') {
            $user = User::getUser($id);
            return View::make('users.edit', compact('user'));
        } else {
            $msg = "You cannot edit this content! ";
            Session::flash('error', $msg);
            return Redirect::to("users/index");
        }
    }

    public function postTags() {
        $query = Input::get('query');

        $results = Tag::select('name')->where('name', 'LIKE', '%' . $query . '%')->get();

        $data = array();
        // Loop through the results.
        //
      foreach ($results as $result):
            $data[] = $result->name;
        endforeach;

        // Return a response.
        //
     return Response::json($data);
    }

    /**
     * Show the form for editing user.
     *
     * @return Response
     */
    public function postEdit($id) {

        $validator = Validator::make(Input::all(), $this->editRules);

        if ($validator->fails()) {
            return Redirect::to('users/edit/' . $id)
                            ->withInput()
                            ->withErrors($validator);
        } else {
            $user = User::find($id);
            if (Input::get('full_name') != null) {
                $user->full_name = Input::get('full_name');
            }
            $user->save();
            // TODO is this final?
            $msg = 'User data was successfully updated!';

            Session::flash('success', $msg);
            return Redirect::to("users/view/" . $id);
        }
    }

    /**
     * Show the form for editing user.
     *
     * @return Response
     */
    public function getConfirmUser() {

        $msg = 'An email with confirmation procedure was successfully sent to <b>' . Auth::user()->email . '</b>.
            <br/>Please follow the instructions in the email to confirm the user!';

        Email::sendConfirmationEmail(Auth::user()->email, Auth::user()->username, Auth::user()->confirmation_code);

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
            $user->confirmation_code = str_replace("/", "", Hash::make(Input::get('email')));

            $user->save();
            Auth::login($user);

            Email::sendConfirmationEmail($user->email, $user->username, $user->confirmation_code);

            // TODO is this final?
            $msg = 'An email with confirmation procedure was successfully sent to <b>' . Auth::user()->email . '</b>.
            <br/>Please follow the instructions in the email to confirm the user!';

            Session::flash('success', $msg);
            return Redirect::to("users/profile");
        }
    }

    public function getConfirmation($code) {
        $user = User::whereRaw('confirmation_code = ?', array($code))->get();


        if ($user[0] != null /* && $user[0]->id == Auth::user()->id */) {
            //$user[0]->confirmed = 1;
            User::where('confirmation_code', $code)->update(array('confirmed' => 1));
            Auth::login($user[0]);
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

    public function getFb() {
        $facebook = new Facebook(Config::get('facebook'));
        $params = array(
            'redirect_uri' => url('users/fb-callback'),
            'scope' => 'email'
        );
        return Redirect::to($facebook->getLoginUrl($params));
    }

    public function getFbCallback() {
        $code = Input::get('code');

        if (strlen($code) == 0) {
            return Redirect::to('users/login')->with('message', 'There was an error communicating with Facebook');
        }

        $facebook = new Facebook(Config::get('facebook'));
        $uid = $facebook->getUser();

        if ($uid == 0) {
            return Redirect::to('users/login')->with('message', 'There was an error');
        }

        $me = $facebook->api('/me');
        $profile = Profile::whereUid($uid)->first();

        if (empty($profile)) {
            $user = new User;
            $user->email = $me['email'];

            if (isset($me['username'])) {
                $user->username = $me['username'];
            } else {
                $user->username = $me['name'];
            }
            $user->save();

            User::where('email', $user->email)->update(array('confirmed' => 1));

            $profile = new Profile();
            $profile->uid = $uid;
            $profile->username = $user['username'];
            $profile = $user->profiles()->save($profile);
        } else {
            
        }

        $profile->access_token = $facebook->getAccessToken();
        $profile->save();

        Auth::login($profile->user);
        return Redirect::to('users/profile')->with('message', "Logged in with Facebook");
    }

    public function postIndex() {
        $users = User::all();
        $iarray = Input::all();

        foreach ($users as $u) {
            if ($u->user_type != $iarray['user' . $u->id]) {
                User::where('email', $u->email)->update(array('user_type' => $iarray['user' . $u->id]));
            }
        }
        return Redirect::to('users/index');
    }

    public function addToFavorites($id) {
        $favorite = new Favorite;
        $favorite->user_1 = Auth::user()->id;
        $favorite->user_2 = $id;
        $favorite->save();
    }
    
    public function deleteFromFavorites($id){
        $id1 = Auth::user()->id;

        $query = "delete from favorites where user_1 = '" . $id1 ."' and user_2 = '" . $id ."'";
        DB::delete(DB::raw($query));
    }

    public function change_permission() {
        $users = User::all();
        $iarray = Input::all();

        foreach ($users as $u) {
            if ('user' . $u->id == $iarray['id']) {
                User::where('email', $u->email)->update(array('user_type' => $iarray['user_type']));
            }
        }
    }

    public function downgrade($id) {
        User::where('id', $id)->update(array('user_type' => "Standard"));
        return Redirect::to('users/profile');
    }

    public function upgrade($id) {
        User::where('id', $id)->update(array('user_type' => "Premium"));
        return Redirect::to('users/profile');
    }

    public function removeNotifications(){
        if(Auth::check())
        {
            Notification::setNotificationsOfUser(Auth::user()->id);
        }
    }
}
