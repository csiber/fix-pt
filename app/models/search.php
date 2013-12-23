<?php

class Search extends Eloquent {

    
    public static function recent_requests($params,$local)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
				$query = "(select id,post_id,title,created_at,category_id from fix_requests) union (select id,post_id,title,created_at,category_id from promotion_pages) order by created_at desc";
			}
			else {
				$query = "(select id,post_id,title,created_at,category_id from fix_requests where location_id = '" . $local . "') union (select id,post_id,title,created_at,category_id from promotion_pages where location_id = '" . $local . "') order by created_at desc";
			}
		}
		else {
			if(is_null($local) || $local == "") {
				$query = "(select id,post_id,title,created_at,category_id from fix_requests where title like '%" . $params . "%') union (select id,post_id,title,created_at,category_id from promotion_pages where title like '%" . $params . "%') order by created_at desc";
			}
			else {
				$query = "(select id,post_id,title,created_at,category_id from fix_requests where title like '%" . $params . "%' and location_id = '" . $local . "') union (select id,post_id,title,created_at,category_id from promotion_pages where title like '%" . $params . "%' and location_id = '" . $local . "') order by created_at desc";
			}
		}
		return DB::select(DB::raw($query));
    }
	
	public static function get_distritos()
	{
		return DB::select(DB::raw('select * from districts order by id asc'));
	}
	
	public static function get_concelhos_distrito($did)
	{
		return DB::table('concelhos')->where("district_id","=",$did)->get();
	}
	
	public static function get_concelhos_por_distritos()
	{
		$query = "select concelhos.id as id, concelhos.name as name, concelhos.district_id, districts.name as distrito from concelhos, districts where concelhos.district_id = districts.id order by concelhos.district_id, id";
		return DB::select(DB::raw($query));
	}
	
}

?>