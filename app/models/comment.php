<?php

class Comment extends Eloquent {
    
    protected $fillable = array('fix_request_id','answer_id','post_id','promotion_page_id');

    public static function getCommentsOfFixRequest($fix_request_id)
    {
    	//$comments = Comment::has('fix_request_id','=',$fix_request_id);
    	$comments = DB::select(DB::raw('SELECT text, user_id FROM comments, posts 
    					WHERE fix_request_id = '. $fix_request_id .' and post_id = posts.id'));


    	return $comments;
    }
}

?>