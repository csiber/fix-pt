<?php

class Job extends Eloquent {
    
    protected $fillable = array('user_id', 'fix_offer_id', 'fix_request_id', 'rate_id');

    public static function getJobsOfFixRequest($fixrequestid)
    {
        return Job::with('fixoffer')->whereRaw('fix_request_id = ?', array($fixrequestid))->get();
    }

    // definition of relations

    public function fixer()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function fixoffer() 
    {
        return $this->belongsTo('FixOffer', 'fix_offer_id');
    }

    public function notifiable()
    {
        return $this->belongsTo('Notifiable');
    }
}

?>