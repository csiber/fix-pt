<?php

class Comment extends Eloquent {
    
    protected $fillable = array('fix_request_id','answer_id','post_id','promotion_page_id');

    public static function getCommentsOfFixRequest($fix_request_id)
    {
        return Comment::with('post')->whereRaw('fix_request_id = ?', array($fix_request_id))->get();
    }

    // definition of relations

    public function post()
    {
        return $this->belongsTo('Post');
    }
}

?>