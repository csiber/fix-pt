<?php

class Post extends Eloquent {

    protected $fillable = array('text', 'user_id');
    
    public function notifiable()
    {
        return $this->belongsTo('Notifiable');
    }

    // Not really sure if this is correct
    public function fixrequest()
    {
        return $this->hasOne('FixRequest');
    }

    public function promotionpage()
    {
        return $this->hasOne('PromotionPage');
    }
}

?>