<?php

class Notifiable extends Eloquent {
    
    public function post()
    {
        return $this->hasOne('Post');
    }

    public function job()
    {
        return $this->hasOne('Job');
    }
}

?>