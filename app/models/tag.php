<?php

class Tag extends Eloquent {
    
    public static function exists($name)
    {
        return Tag::where('name', "=", $name)->count() > 0;
    }

    public static function getTagByName($name)
    {
        return Tag::where('name', '=', $name)->get()[0];
    }
}

?>