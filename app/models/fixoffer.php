<?php

class FixOffer extends Eloquent {

    public $timestamps = false;
    protected $fillable = array('fix_request_id','post_id','value');

    public static function getFixOffersOfFixRequest($fix_request_id)
    {
        return FixOffer::with('post')->whereRaw('fix_request_id = ?', array($fix_request_id))->get();
    }

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public function fixrequest()
    {
        return $this->belongsTo('FixRequest');
    }
}

?>