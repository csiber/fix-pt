<?php

class PromotionPage extends Eloquent {
    
    protected $fillable = array('title', 'city', 'concelho');

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public function category()
    {
        return $this->belongsTo('Category');
    }
	
	public static function getPromotionPages($params,$local)
    {
		if(is_null($params) || $params == "") {
			if(is_null($local) || $local == "") {
        		return PromotionPage::orderBy('created_at', 'DESC');
			}
			else {
        		return PromotionPage::where("location_id",$local)->orderBy('created_at', 'DESC');
			}
		}
		else {
        	if(is_null($local) || $local == "") {
				return PromotionPage::where("title","like","%".$params."%")->orderBy('created_at', 'DESC');
			}
			else {
				return PromotionPage::where("title","like","%".$params."%","and","location_id","=",$local)->orderBy('created_at', 'DESC');				
			}
		}
	}

    public static function getPromotionPage($id)
    {

        return PromotionPage::with(array('post'))->find($id);
    }

    public static function isTherePromotionPage()
    {
        $id1 = Auth::user()->id;
        $query = "(select promotion_pages.post_id from promotion_pages INNER JOIN posts ON promotion_pages.post_id = posts.id AND posts.user_id = '".$id1."')";
        if(DB::select(DB::raw($query)))
        {
            //Utilfunctions::dump(DB::select(DB::raw($query)));
            return true;
        }
        
        //Utilfunctions::dump(DB::select(DB::raw($query)));
        return false;
    }

    public static function getPromotionPageID()
    {
        $id1 = Auth::user()->id;
        $query = "(select promotion_pages.id from promotion_pages INNER JOIN posts ON promotion_pages.post_id = posts.id AND posts.user_id = '".$id1."')";
        return DB::select(DB::raw($query));
    }

    public static function getPromotionPageNoId()
    {
        $id1 = Auth::user()->id;
        $query = "(select promotion_pages.id, promotion_pages.post_id, promotion_pages.title, posts.text from promotion_pages INNER JOIN posts ON promotion_pages.post_id = posts.id AND posts.user_id = '".$id1."')";
        return DB::select(DB::raw($query));
    }
}

?>