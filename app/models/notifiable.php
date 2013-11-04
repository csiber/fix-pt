<?php

class Notifiable extends Eloquent {
    
    public function post()
    {
        return $this->hasOne('Post');
    }
}

?>