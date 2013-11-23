<?php

class FixRequestsTag extends Eloquent {
    
    public function tag()
    {
        return $this->belongsTo('Tag');
    }
}

?>