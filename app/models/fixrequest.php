<?php

class FixRequest extends Eloquent {

    protected $fillable = array('title', 'state', 'daysForOffer', 'value');
    
    public function tags()
    {
        return $this->belongsToMany('Tag', 'fix_requests_tags', 'fix_request_id', 'tag_id');
    }

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public function fixoffers()
    {
        return $this->hasMany('FixOffer');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

    public function categories()
    {
        return $this->belongsTo('Category');
    }
}

?>