<?php

class District extends Eloquent {

    public static function getDistricts()
    {
        return District::all();
    }

    // definition of relations

    public function concelhos()
    {
        return $this->hasMany('Concelho');
    }

    public function fixrequests()
    {
        return $this->hasMany('FixRequest');
    }
}

?>