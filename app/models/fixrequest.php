<?php

class FixRequest extends Eloquent {

    protected $fillable = array('title', 'state', 'daysForOffer', 'value');
    
    public static function recent_requests()
    {
        return FixRequest::with('tags')->orderBy('created_at', 'DESC');
    }

    public static function popular_requests()
    {
        // todo
        return FixRequest::with('tags');
    }

    public static function no_offers_requests()
    {
        return FixRequest::with('tags')->has('fixoffers', "=", 0);
    }

    // Relations

    public function tags()
    {
        return $this->belongsToMany('Tag', 'fix_requests_tags', 'fix_request_id', 'tag_id');
    }

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function fixoffers()
    {
        return $this->hasMany('FixOffer');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }
}

?>