<?php

class Post extends Eloquent {

    protected $fillable = array('text', 'user_id');
    

    // Definition of relations

    public function notifiable()
    {
        return $this->belongsTo('Notifiable');
    }

    public function fixrequest()
    {
        // Not really sure if this is correct
        return $this->hasOne('FixRequest');
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