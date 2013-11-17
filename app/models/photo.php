<?php

class Photo extends Eloquent {

    protected $fillable = array('path');

    public function post()
    {
        return $this->belongsTo('Post');
    }
}

?>