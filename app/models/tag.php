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

    public static Function getPopular($number)
    {
        return DB::table('tags')
                    ->join('fix_requests_tags', 'tags.id', '=', 'fix_requests_tags.tag_id')
                    ->select(DB::raw('tags.id, name, count(*) as used'))
                    ->groupBy('tag_id')
                    ->orderBy('used', 'DESC')
                    ->take($number)
                    ->get();
    }


    // definition of relations

    public function fixrequests()
    {
        return $this->belongsToMany('FixRequest', 'fix_requests_tags', 'fix_request_id', 'tag_id');
    }

    public function fixRequestTags()
    {
        return $this->hasMany('FixRequestTag');
    }
}

?>