<?php

class SearchController extends BaseController {
    
    /**
    * Display a listing of posts according to given parameters
    *
    * @return Response
    */
    public function getIndex($sort=null)
    {
        $terms = Session::get('terms');
        $local = Session::get('local');
        $posts_per_page = 5;
        $cont = 1;
        if ($sort == "recent") {
            $resul = Search::recent_requests($terms,$local);
            $res = Paginator::make($resul, count($resul), $posts_per_page);
        } else if ($sort == "popular") {
            //TODO: popular (?)
            $resul = Search::recent_requests($terms,$local);
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
        foreach($resul as &$re) {
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
        $concelhos = array();
        $concs = Search::get_concelhos_por_distritos();
        foreach ($concs as $conc)
        {
            array_push($concelhos,array($conc->id, $conc->name,$conc->distrito));
        }
        return View::make('search.index', array('searchresults' => $searchresults, 'pags' => $res, "sort" => $sort, "concs" => $concelhos, "text" => $terms, "selconcelho" => $local));
    }
    
    public function postIndex()
    {
        Session::put('terms', Input::get('text'));
        Session::put('local', Input::get('concelhos'));
        return $this->getIndex(null);
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
    
    public function getDistritosList()
    {
        $dist = Search::get_distritos();
        $distritos = array();
        foreach ($dist as $dis)
        {
            array_push($distritos,array($dis->id,$dis->name));
        }
        return $distritos;
    }
    
}