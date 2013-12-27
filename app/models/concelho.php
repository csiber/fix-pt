<?php

class Concelho extends Eloquent {

    public static function getAll()
    {
        return Concelho::all();
    }

    public static function getConcelhos($districtId)
    {
        return Concelho::whereRaw('district_id = ?', array($districtId))->get();
    }

    // definition of relations

    public function district()
    {
        return $this->belongsTo('District');
    }

    public function fixrequests()
    {
        return $this->hasMany('FixRequest');
    }
}

?>