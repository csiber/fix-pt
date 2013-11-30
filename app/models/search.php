<?php

class Search extends Eloquent {

    
    public static function recent_requests($params)
    {
		if(is_null($params) || $params == "")
			return DB::select(DB::raw('(select post_id,title,created_at,category_id from fix_requests) union (select post_id,title,created_at,category_id from promotion_pages) order by created_at desc'));
		else
			return DB::select(DB::raw('(select post_id,title,created_at,category_id from fix_requests where title like %?%) union (select post_id,title,created_at,category_id from promotion_pages where title like %?%) order by created_at desc'),array($params,$params));
    }
	
}

?>