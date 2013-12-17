<?php

class Search extends Eloquent {

    
    public static function recent_requests($params,$local)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
				$query = "(select post_id,title,created_at,category_id from fix_requests) union (select post_id,title,created_at,category_id from promotion_pages) order by created_at desc";
			}
			else {
				$query = "(select post_id,title,created_at,category_id from fix_requests where location_id = '" . $local . "') union (select post_id,title,created_at,category_id from promotion_pages where location_id = '" . $local . "') order by created_at desc";
			}
		}
		else {
			if(is_null($local) || $local == "") {
				$query = "(select post_id,title,created_at,category_id from fix_requests where title like '%" . $params . "%') union (select post_id,title,created_at,category_id from promotion_pages where title like '%" . $params . "%') order by created_at desc";
			}
			else {
				$query = "(select post_id,title,created_at,category_id from fix_requests where title like '%" . $params . "%' and location_id = '" . $local . "') union (select post_id,title,created_at,category_id from promotion_pages where title like '%" . $params . "%' and location_id = '" . $local . "') order by created_at desc";
			}
		}
		return DB::select(DB::raw($query));
    }
	
	public static function get_distritos()
	{
		return DB::select(DB::raw('select * from districts order by id asc'));
	}
	
	public static function get_concelhos()
	{
		return DB::select(DB::raw('select * from concelhos order by id asc'));
	}
	
	public static function get_concelhos_distrito($did)
	{
		return DB::table('concelhos')->where("district_id","=",$did)->get();
	}
	
	public static function get_distrito_by_concelho($cid)
	{
		return DB::table('concelhos')->where("id","=",$cid)->pluck('district_id');
	}
	
}

?>