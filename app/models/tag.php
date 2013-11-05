<?php

class Tag extends Eloquent {

    protected $fillable = array('name');
    
    public static function exists($name)
    {
        return Tag::where('name', "=", $name)->count() > 0;
    }

    public static function getTagByName($name)
    {
        return Tag::where('name', '=', $name)->first();
    }

    public function fixrequests()
    {
        return $this->belongsToMany('FixRequest', 'fix_requests_tags', 'fix_request_id', 'tag_id');
    }
}

?>