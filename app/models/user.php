<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    public static function getUser($id) {
        return User::find($id);
    }

    public static function getFavorites(){
        $id1 = Auth::user()->id;
        $query =  "(select favorites.user_2, users.username from favorites INNER JOIN users ON users.id = favorites.user_2 AND favorites.user_1 = '".$id1."')";
        $result = DB::select(DB::raw($query));
        //Utilfunctions::dump($result[1]);
        if($result)
        {
            return $result;
        }
       
    }

    // Definition of relations

    public function posts() {
        return $this->hasMany('Post');
    }

    public function profiles() {
        return $this->hasMany('Profile');
    }

    public function jobs() {
        return $this->hasMany('Job');
    }
}