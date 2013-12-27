<?php


class FixRequest extends Eloquent {

    protected $fillable = array('title', 'state', 'daysForOffer', 'value', 'city', 'concelho');
    
    public static function recent_requests($category=null)
    {
        if($category != null) {
            return FixRequest::with('tags')->whereRaw('category_id = ?', array($category))->has('jobs', "=", 0)->orderBy('created_at', 'DESC');
        }
        return FixRequest::with('tags')->has('jobs', "=", 0)->orderBy('created_at', 'DESC');
    }
    
    public static function recent_requests_search($params, $local, $category=null)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return FixRequest::recent_requests($category);
			}
			else {
                return FixRequest::recent_requests($category)->whereRaw("city = ?", array(ucfirst(strtolower($local))));
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return FixRequest::recent_requests($category)->where("title","like","%".$params."%");
			}
			else {
            return FixRequest::recent_requests($category)->where("city", "=", ucfirst(strtolower($local)))->where("title","like","%".$params."%");
			}
		}
    }

    public static function popular_requests($category=null)
    {
        if($category != null) {
            return FixRequest::with('tags')->whereRaw('category_id = ?', array($category))->has('jobs', "=", 0)->has('fixoffers', '>', 0)->has('comments', '>', 0)->orderBy('created_at', 'DESC');
        }
        return FixRequest::with('tags')->has('jobs', "=", 0)->has('fixoffers', '>', 0)->has('comments', '>', 0)->orderBy('created_at', 'DESC');
    }
    
    public static function popular_requests_search($params,$local, $category=null)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return FixRequest::popular_requests($category);
			}
			else {
        		return FixRequest::popular_requests($category)->whereRaw("city = ?",array(ucfirst(strtolower($local))));
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return FixRequest::popular_requests($category)->where("title","like","%".$params."%");
			}
			else {
				return FixRequest::popular_requests($category)->where("title","like","%".$params."%")->where("city","=", ucfirst(strtolower($local)));				
			}
		}
    }

    public static function no_offers_requests($category=null)
    {
        if($category != null) {
            return FixRequest::with('tags')->whereRaw('category_id = ?', array($category))->has('fixoffers', "=", 0)->orderBy('created_at', 'DESC');
        }
        return FixRequest::with('tags')->has('fixoffers', "=", 0)->orderBy('created_at', 'DESC');
    }
    
    public static function no_offers_requests_search($params,$local, $category=null)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return FixRequest::no_offers_requests($category);
			}
			else {
        		return FixRequest::no_offers_requests($category)->whereRaw("city = ?", array(ucfirst(strtolower($local))));
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return FixRequest::no_offers_requests($category)->where("title","like","%".$params."%");
			}
			else {
				return FixRequest::no_offers_requests($category)->where("title","like","%".$params."%")->whereRaw("city = ?", array(ucfirst(strtolower($local))));				
			}
		}
    }

    public static function ending_soon_requests($category=null)
    {
        if($category != null) {
            return FixRequest::endingSoon()->with('tags')->whereRaw('category_id = ?', array($category))->has('jobs', "=", 0)->orderBy('created_at', 'DESC');
        }
        return FixRequest::endingSoon()->with('tags')->has('jobs', "=", 0)->orderBy('created_at', 'DESC');
    }
    
    public static function ending_soon_requests_search($params,$local, $category=null)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return FixRequest::ending_soon_requests($category);
			}
			else {
        		return FixRequest::ending_soon_requests($category)->whereRaw("city = ?", array(ucfirst(strtolower($local))));
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return FixRequest::ending_soon_requests($category)->where("title","like","%".$params."%");
			}
			else {
				return FixRequest::ending_soon_requests($category)->where("title","like","%".$params."%")->whereRaw("city = ?", array(ucfirst(strtolower($local))));				
			}
		}
    }

    public static function in_progress_requests($category=null)
    {
        if($category != null) {
            return FixRequest::with('tags')->whereRaw('category_id = ?', array($category))->has('jobs', ">", 0)->orderBy('created_at', 'DESC');
        }
        return FixRequest::with('tags')->has('jobs', ">", 0)->orderBy('created_at', 'DESC');
    }
    
    public static function in_progress_requests_search($params,$local, $category=null)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return FixRequest::in_progress_requests($category);
			}
			else {
        		return FixRequest::in_progress_requests($category)->whereRaw("city = ?", array(ucfirst(strtolower($local))));
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return FixRequest::in_progress_requests($category)->where("title","like","%".$params."%");
			}
			else {
				return FixRequest::in_progress_requests($category)->where("title","like","%".$params."%")->whereRaw("city = ?", array(ucfirst(strtolower($local))));				
			}
		}
    }

    public static function getFixRequest($id)
    {
        return FixRequest::with(array('post', 'tags', 'category'))->find($id);
    }

    public static function getRelatedRequests($id)
    {
        $fixrequest = FixRequest::getFixRequest($id);
        $fixrequests = FixRequest::whereRaw('category_id = ?', array($fixrequest->category_id));
        return $fixrequests->take(4)->get();
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