<?php

class SearchController extends BaseController {
    
	public $terms; // TODO: guardar a pesquisa na session
	public $local; // TODO: guardar a pesquisa na session
	
	/**
    * Display a listing of posts according to given parameters
    *
    * @return Response
    */
    public function getIndex($sort=null)
    {
        $posts_per_page = 5;
		$cont = 1;
        if ($sort == "recent") {
            $resul = Search::recent_requests($this->terms,$this->local);
			$res = Paginator::make($resul, count($resul), $posts_per_page);
        } else if ($sort == "popular") {
			//TODO: popular (?)
            $resul = Search::recent_requests($this->terms,$this->local);
			$res = Paginator::make($resul, count($resul), $posts_per_page);
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
		$chosen = Search::get_distrito_by_concelho($this->local);
		$distritos = array();
		$dists = Search::get_distritos();
		foreach ($dists as $dist)
		{
			array_push($distritos,array($dist->id, $dist->name));
		}
		$concelhos = array();
		$concs = Search::get_concelhos();
		foreach ($concs as $conc)
		{
			array_push($concelhos,array($conc->id, $conc->name));
		}
        return View::make('search.index', array('searchresults' => $searchresults, 'pags' => $res, "sort" => $sort, "dists" => $distritos, "concs" => $concelhos, "text" => $this->terms, "seldistrito" => $chosen, "selconcelho" => $this->local));
    }
	
    public function postIndex()
    {
		$this->terms = Input::get('text');
		$this->local = Input::get('location');
		return $this->getIndex("recent");
	}
	
	public function getConcelhosList()
	{
		$conc = Search::get_concelhos_distrito(Input::get('did'));
		$concelhos = array();
		foreach ($conc as $con)
		{
			array_push($concelhos,array($con->id,$con->name));
		}
		return $concelhos;
	}
	
}