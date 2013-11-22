<?php

class FixRequest extends Eloquent {

    protected $fillable = array('title', 'state', 'daysForOffer', 'value');
    
    public static function recent_requests()
    {
        return FixRequest::with('tags')->orderBy('created_at', 'DESC');
    }

    public static function popular_requests()
    {
        // TODO it should return the most popular requests (what defines popular?)
        return FixRequest::with('tags');
    }

    public static function no_offers_requests()
    {
        return FixRequest::with('tags')->has('fixoffers', "=", 0)->orderBy('created_at', 'DESC');
    }

    public static function ending_soon_requests()
    {
        return FixRequest::endingSoon()->with('tags')->orderBy('created_at', 'DESC');
    }

    public static function getFixRequest($id)
    {
        return FixRequest::with(array('post', 'tags', 'category'))->find($id);
    }



    // Definition of scopes

    public function scopeEndingSoon($query)
    {
        $from = \Carbon\Carbon::now();
        $to = $from->copy()->addDays(1);
        // TODO i think this only works in postgresql
        // check http://www.the-art-of-web.com/sql/postgres-mysql/ for info on the mySQL version
        return $query->whereRaw("created_at + INTERVAL daysForOffer * '1' day between '$from' and '$to'");
    }



    // Definition of relations

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