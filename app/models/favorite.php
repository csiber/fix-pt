<?php

class Favorite extends Eloquent {

    public static function checkFavorite($id2)
    {
        $id1 = Auth::user()->id;
        $favorite = Favorite::whereRaw('user_1 = ? AND user_2 = ?', array(Auth::user()->id, $id2))->first();
        return $favorite;

     //    $query = "(select * from favorites where user_1 = '" . $id1 ."' and user_2 = '" . $id2 ."')";
     //   	if(DB::select(DB::raw($query)))
    	// {
    	// 		return true;
    	// }
    	
    	// return false;
    }

    public function user()
    {
        return $this->belongsTo('User');
    }
}

?>