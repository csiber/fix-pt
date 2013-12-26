<?php

class PromotionPage extends Eloquent {
    
    protected $fillable = array('title');

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public static function getPromotionPage($id)
    {

        return PromotionPage::with(array('post'))->find($id);
    }

    public static function isTherePromotionPage()
    {
        $id1 = Auth::user()->id;
        $query = "(select promotion_pages.post_id from promotion_pages INNER JOIN posts ON promotion_pages.post_id = posts.id AND posts.user_id = '".$id1."')";
        if(DB::select(DB::raw($query)))
        {
            return true;
        }
        
        return false;
    }

    public static function getPromotionPageID()
    {
        $id1 = Auth::user()->id;
        $query = "(select promotion_pages.id from promotion_pages INNER JOIN posts ON promotion_pages.post_id = posts.id AND posts.user_id = '".$id1."')";
        return DB::select(DB::raw($query));
    }

    public static function getPromotionPageNoId()
    {
        $id1 = Auth::user()->id;
        $query = "(select promotion_pages.id, promotion_pages.post_id, promotion_pages.title, posts.text from promotion_pages INNER JOIN posts ON promotion_pages.post_id = posts.id AND posts.user_id = '".$id1."')";
        return DB::select(DB::raw($query));
    }
}

?>