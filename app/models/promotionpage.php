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
}

?>