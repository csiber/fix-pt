<?php

class Search extends Eloquent {

    
    public static function recent_requests($params,$local)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
				$query = "(select id,post_id,title,city,concelho,created_at,category_id from fix_requests) union (select id,post_id,title,city,concelho,created_at,category_id from promotion_pages) order by created_at desc";
			}
			else {
				$query = "(select id,post_id,city,concelho,title,created_at,category_id from fix_requests where location_id = '" . $local . "') union (select id,post_id,city,concelho,title,created_at,category_id from promotion_pages where location_id = '" . $local . "') order by created_at desc";
			}
		}
		else {
			if(is_null($local) || $local == "") {
				$query = "(select id,post_id,title,city,concelho,created_at,category_id from fix_requests where title like '%" . $params . "%') union (select id,post_id,title,city,concelho,created_at,category_id from promotion_pages where title like '%" . $params . "%') order by created_at desc";
			}
			else {
				$query = "(select id,post_id,title,city,concelho,created_at,category_id from fix_requests where title like '%" . $params . "%' and location_id = '" . $local . "') union (select id,post_id,title,city,concelho,created_at,category_id from promotion_pages where title like '%" . $params . "%' and location_id = '" . $local . "') order by created_at desc";
			}
		}
		return DB::select(DB::raw($query));
    }
	
	public static function popular_requests($params,$local)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
				$query = "(select fix_requests.id,fix_requests.post_id,fix_requests.city, fix_requests.concelho,fix_requests.title,fix_requests.created_at,fix_requests.category_id,count(*) as comms from fix_requests,comments where fix_requests.id = comments.fix_request_id group by post_id) union (select promotion_pages.id,promotion_pages.post_id,promotion_pages.city, promotion_pages.concelho,promotion_pages.title,promotion_pages.created_at,promotion_pages.category_id,count(*) as comms from promotion_pages,comments where promotion_pages.id = comments.promotion_page_id group by post_id) order by comms desc";
			}
			else {
				$query = "(select fix_requests.id,fix_requests.post_id,fix_requests.city, fix_requests.concelho,fix_requests.title,fix_requests.created_at,fix_requests.category_id,count(*) as comms from fix_requests,comments where fix_requests.id = comments.fix_request_id and location_id = '" . $local . "' group by post_id) union (select promotion_pages.id,promotion_pages.city, promotion_pages.concelho,promotion_pages.post_id,promotion_pages.title,promotion_pages.created_at,promotion_pages.category_id,count(*) as comms from promotion_pages,comments where promotion_pages.id = comments.promotion_page_id and location_id = '" . $local . "' group by post_id) order by comms desc";
			}
		}
		else {
			if(is_null($local) || $local == "") {
				
				$query = "(select fix_requests.id,fix_requests.post_id,fix_requests.city, fix_requests.concelho,fix_requests.title,fix_requests.created_at,fix_requests.category_id,count(*) as comms from fix_requests,comments where fix_requests.id = comments.fix_request_id and title like '%" . $params . "%' group by post_id) union (select promotion_pages.id,promotion_pages.city, promotion_pages.concelho,promotion_pages.post_id,promotion_pages.title,promotion_pages.created_at,promotion_pages.category_id,count(*) as comms from promotion_pages,comments where promotion_pages.id = comments.promotion_page_id and title like '%" . $params . "%' group by post_id) order by comms desc";
			}
			else {
				
				$query = "(select fix_requests.id,fix_requests.post_id,fix_requests.city, fix_requests.concelho,fix_requests.title,fix_requests.created_at,fix_requests.category_id,count(*) as comms from fix_requests,comments where fix_requests.id = comments.fix_request_id and title like '%" . $params . "%' and location_id = '" . $local . "' group by post_id) union (select promotion_pages.id,promotion_pages.city, promotion_pages.concelho,promotion_pages.post_id,promotion_pages.title,promotion_pages.created_at,promotion_pages.category_id,count(*) as comms from promotion_pages,comments where promotion_pages.id = comments.promotion_page_id and title like '%" . $params . "%' and location_id = '" . $local . "' group by post_id) order by comms desc";
			}
		}
		return DB::select(DB::raw($query));
	}
	
	public static function getType($id,$pid)
	{
		return DB::table('fix_requests')
        ->select(DB::raw('count(*) as rowcount'))
        ->where('id','=',$id,'and','post_id','=',$pid)
        ->get();
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