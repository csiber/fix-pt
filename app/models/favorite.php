<?php

class Favorite extends Eloquent {
    public static function checkFavorite($id1, $id2)
    {
    	$resultado1 = Favorite::with(array('id_user1'))->find($id1);
       	if($resultado1)
    	{
    		if($resultado1->id_user2 == $id2)
    			return 1;
    	} else return 0;
    	
    	return 0;
    }

}

?>