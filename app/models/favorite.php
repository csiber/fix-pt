<?php

class Favorite extends Eloquent {

    public static function checkFavorite($id2)
    {
        $id1 = Auth::user()->id;
        $query = "(select * from favorites where user_1 = '" . $id1 ."' and user_2 = '" . $id2 ."')";
       	if(DB::select(DB::raw($query)))
    	{
    			return true;
    	}
    	
    	return false;
    }

}

?>