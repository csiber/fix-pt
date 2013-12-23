<?php

class Job extends Eloquent {
    
    protected $fillable = array('user_id', 'fixer_id', 'fix_offer_id', 'fix_request_id');

    public static function getJobsOfFixRequest($fixrequestid)
    {
        return Job::with('fixoffer')->whereRaw('fix_request_id = ?', array($fixrequestid))->get();
    }



    // definition of relations

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function fixer()
    {
        return $this->belongsTo('User', 'fixer_id');
    }

    public function fixoffer() 
    {
        return $this->belongsTo('FixOffer', 'fix_offer_id');
    }

    public function fixrequest()
    {
        return $this->belongsTo('FixRequest', 'fix_request_id');
    }

    public function notifiable()
    {
        return $this->belongsTo('Notifiable');
    }
}

?>