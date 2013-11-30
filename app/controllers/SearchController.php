<?php

class SearchController extends BaseController {
	
    /**
    * Display a listing of fix requests
    *
    * @return Response
    */
    public function getIndex($sort=null,$terms="")
    {
        $posts_per_page = 5;
		$cont = 1;
        if ($sort == "recent") {
            $resul = Search::recent_requests($terms);
			$res = Paginator::make($resul, count($resul), $posts_per_page);
        } else if ($sort == "popular") {
            $res = FixRequest::popular_requests()->paginate($posts_per_page);
        } else {
            return Redirect::to('search/index/recent');
        }
		if(isset($_GET['page']))
			$pag = $_GET['page'];
		else
			$pag = 1;
		$start = ($pag - 1) * $posts_per_page;
		$end = $pag * $posts_per_page;
        $searchresults = array();
        foreach($res as &$re) {
			if(($cont > $start) && ($cont <= $end)) {
				$post = Post::find($re->post_id);
				$user = User::find($post['user_id']);
				$sr = new stdClass;
				$sr->title = $re->title;
				$sr->text = UtilFunctions::truncateString($post['text'], 220);
				$sr->user_id = $post['user_id'];
				$sr->username = $user['username'];
				$sr->user_image = $user['user_image'];
				$sr->created_at_pretty = UtilFunctions::prettyDate($re->created_at);
				$cat = Category::find($re->category_id);
				$sr->category = $cat['name'];
				array_push($searchresults,$sr);
			}
			$cont = $cont + 1;
        }
        return View::make('search.index', array('searchresults' => $searchresults, 'pags' => $res, "sort" => $sort));
    }
	
    public function postIndex()
    {
		$terms = Input::get('text');
		return $this->getIndex("recent",$terms);// mudar
	}
}