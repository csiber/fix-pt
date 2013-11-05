<?php

class Category extends Eloquent {

    protected $table = 'categories';
    protected $fillable = array('name');
    public $timestamps = false;

    public function fixrequests()
    {
        return $this->hasMany('fixrequests');
    }
}

?>