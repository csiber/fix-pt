<?php


class FixRequest extends Eloquent {

    protected $fillable = array('title', 'state', 'daysForOffer', 'value', 'city', 'concelho');
    
    public static function recent_requests()
    {
        return FixRequest::with('tags')->has('jobs', "=", 0)->orderBy('created_at', 'DESC');
    }
    
    public static function recent_requests_search($params,$local)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return FixRequest::recent_requests();
			}
			else {
        		return FixRequest::recent_requests()->where("location_id",$local);
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return FixRequest::recent_requests()->where("title","like","%".$params."%");
			}
			else {
				return FixRequest::recent_requests()->where("title","like","%".$params."%","and","location_id","=",$local);				
			}
		}
    }

    public static function popular_requests()
    {
        return FixRequest::with('tags')->has('jobs', "=", 0)->has('fixoffers', '>', 0)->has('comments', '>', 0)->orderBy('created_at', 'DESC');
    }
    
    public static function popular_requests_search($params,$local)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return FixRequest::popular_requests();
			}
			else {
        		return FixRequest::popular_requests()->where("location_id",$local);
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return FixRequest::popular_requests()->where("title","like","%".$params."%");
			}
			else {
				return FixRequest::popular_requests()->where("title","like","%".$params."%","and","location_id","=",$local);				
			}
		}
    }

    public static function no_offers_requests()
    {
        return FixRequest::with('tags')->has('fixoffers', "=", 0)->orderBy('created_at', 'DESC');
    }
    
    public static function no_offers_requests_search($params,$local)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return FixRequest::no_offers_requests();
			}
			else {
        		return FixRequest::no_offers_requests()->where("location_id",$local);
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return FixRequest::no_offers_requests()->where("title","like","%".$params."%");
			}
			else {
				return FixRequest::no_offers_requests()->where("title","like","%".$params."%","and","location_id","=",$local);				
			}
		}
    }

    public static function ending_soon_requests()
    {
        return FixRequest::endingSoon()->with('tags')->has('jobs', "=", 0)->orderBy('created_at', 'DESC');
    }
    
    public static function ending_soon_requests_search($params,$local)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return FixRequest::ending_soon_requests();
			}
			else {
        		return FixRequest::ending_soon_requests()->where("location_id",$local);
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return FixRequest::ending_soon_requests()->where("title","like","%".$params."%");
			}
			else {
				return FixRequest::ending_soon_requests()->where("title","like","%".$params."%","and","location_id","=",$local);				
			}
		}
    }

    public static function in_progress_requests()
    {
        return FixRequest::with('tags')->has('jobs', ">", 0)->orderBy('created_at', 'DESC');
    }
    
    public static function in_progress_requests_search($params,$local)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return FixRequest::in_progress_requests();
			}
			else {
        		return FixRequest::in_progress_requests()->where("location_id",$local);
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return FixRequest::in_progress_requests()->where("title","like","%".$params."%");
			}
			else {
				return FixRequest::in_progress_requests()->where("title","like","%".$params."%","and","location_id","=",$local);				
			}
		}
    }

    public static function getFixRequest($id)
    {
        return FixRequest::with(array('post', 'tags', 'category'))->find($id);
    }



    // Definition of scopes

    public function scopeEndingSoon($query)
    {
        $from = \Carbon\Carbon::now();
        $to = $from->copy()->addDays(1);
        // TODO i think this only works in postgresql
        // check http://www.the-art-of-web.com/sql/postgres-mysql/ for info on the mySQL version
        return $query->whereRaw("created_at + INTERVAL daysForOffer * '1' day between '$from' and '$to'");
    }



    // Definition of relations

    public function tags()
    {
        return $this->belongsToMany('Tag', 'fix_requests_tags', 'fix_request_id', 'tag_id');
    }

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function fixoffers()
    {
        return $this->hasMany('FixOffer');
    }

    public function jobs()
    {
        return $this->hasMany('Job');
    }

    public function district()
    {
        return $this->hasOne('District');
    }

    public function concelho()
    {
        return $this->hasOne('Concelho');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }
}

?>