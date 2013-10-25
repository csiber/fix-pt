<?php

class FixOfferController extends BaseController {

    public function fixrequest()
    {
        $this->belongsTo('FixRequest');
    }
}