<?php

class Post extends Eloquent {

    protected $fillable = array('text', 'user_id');
    

    // Definition of relations

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function notifiable()
    {
        return $this->belongsTo('Notifiable');
    }

    public function fixrequest()
    {
        return $this->hasOne('FixRequest');
    }

    public function comment()
    {
        return $this->hasOne('Comment');
    }

    public function fixoffer() 
    {
        return $this->hasOne('FixOffer');
    }

    public function promotionpage()
    {
        return $this->hasOne('PromotionPage');
    }

    public function photos()
    {
        return $this->hasMany('Photo');
    }
}

?>