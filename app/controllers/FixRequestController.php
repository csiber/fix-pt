<?php

class FixRequestController extends BaseController {

    /**
    * Display a listing of fix requests
    *
    * @return Response
    */
    public function getIndex($sort=null, $filter=null)
    {
        $requests_per_page = 6;

        if ($sort == "recent") {
            $fixrequests = FixRequest::recent_requests($filter)->paginate($requests_per_page);
        } else if ($sort == 'popular') {
            $fixrequests = FixRequest::popular_requests($filter)->paginate($requests_per_page);
        } else if ($sort == 'no_offers') {
            $fixrequests = FixRequest::no_offers_requests($filter)->paginate($requests_per_page); 
        } else if ($sort == 'ending_soon') {
            $fixrequests = FixRequest::ending_soon_requests($filter)->paginate($requests_per_page); 
        } else if ($sort == 'in_progress') {
            $fixrequests = FixRequest::in_progress_requests($filter)->paginate($requests_per_page); 
        } else {
            return Redirect::to('fixrequests/index/recent');
        }

        $popular_tags = Tag::getPopular(10);

        foreach($fixrequests as &$fixrequest) {
            $post = Post::find($fixrequest['post_id']);
            $user = User::find($post['user_id']);
            
            $fixrequest['text'] = UtilFunctions::truncateString(trim(((stripslashes($fixrequest['post']->text)))), 220);
            $fixrequest['user_id'] = $post['user_id'];
            $fixrequest['username'] = $user['username'];
            $fixrequest['user_image'] = $user['user_image'];
            $fixrequest['created_at_pretty'] = UtilFunctions::prettyDate($fixrequest['created_at']);
            $fixrequest['category'] = $fixrequest->category;
            $fixrequest['category_class'] = UtilFunctions::getCategoryIdWord($fixrequest->category['id']);

            $fixrequest['end_date_exact'] = date("Y-m-d H:i:s", strtotime($fixrequest->created_at." + $fixrequest->daysForOffer days"));
            $fixrequest['end_date'] = UtilFunctions::getEndDate($fixrequest['created_at'], $fixrequest['daysForOffer']);
        }

        return View::make('fixrequests.index', array(
            'fixrequests' => $fixrequests,
            "sort" => $sort,
            'filter' => $filter,
            "popular_tags" => $popular_tags,
        ));
    }

    /**
    * Displays a single fix request
    *
    * @return Response
    */
    public function getShow($id)
    {
        $fixrequest = FixRequest::getFixRequest($id);

        if(! $fixrequest) {
            App::abort(404, 'Article not found');
        }

        $fixrequest->views = $fixrequest->views + 1;
        $fixrequest->save();

        $fixrequest['created_at_pretty'] = UtilFunctions::prettyDate($fixrequest['created_at']);
        $fixrequest['updated_at_pretty'] = UtilFunctions::prettyDate($fixrequest['updated_at']);
        $fixrequest['post']->text = trim(nl2br((stripslashes($fixrequest['post']->text))));
        $fixrequest['end_date_exact'] = date("Y-m-d H:i:s", strtotime($fixrequest->created_at." + $fixrequest->daysForOffer days"));
        $fixrequest['end_date'] = UtilFunctions::getEndDate($fixrequest['created_at'], $fixrequest['daysForOffer']);
        $fixrequest['gravatar'] = UtilFunctions::gravatar($fixrequest->post->user->email);

        $comments = Comment::getCommentsOfFixRequest($id);

        foreach($comments as &$comment) {
            $comment->post['text'] = trim(nl2br(($comment->post['text'])));
            $comment['created_at_pretty'] = UtilFunctions::prettyDate($comment['created_at']);
            $comment['gravatar'] = "http://www.gravatar.com/avatar/".md5(strtolower(trim($comment->post->user->email)))."?s=48&r=pg&d=identicon";
        }

        $fixoffers = FixOffer::getFixOffersOfFixRequest($id);
        $hasMadeFixOffer = false;

        foreach($fixoffers as &$fixoffer) {
            $fixoffer['created_at_pretty'] = UtilFunctions::prettyDate($fixoffer->post['created_at']);
            $fixoffer['gravatar'] = "http://www.gravatar.com/avatar/".md5(strtolower(trim($fixoffer->post->user->email)))."?s=48&r=pg&d=identicon";
            if(Auth::user() && $fixoffer->post->user->id == Auth::user()->id) {
                $hasMadeFixOffer = true;
            }
        }

        $jobs = Job::getJobsOfFixRequest($id);
        $fixerJob = Null;
        $requesterJob = Null;

        foreach($jobs as &$job) {
            if($job->user_id == $fixrequest->post->user->id) {
                $requesterJob = $job;
            } else {
                $fixerJob = $job;
            }
        }

        $related = Fixrequest::getRelatedRequests($fixrequest->id);
        foreach($related as &$r) {
            $r['gravatar'] = UtilFunctions::gravatar($r->post->user->email, 24);
        }

        return View::make('fixrequests/show', array(
            'fixrequest' => $fixrequest,
            'comments' => $comments,
            'photos' => $fixrequest->post->photos()->getResults(),
            'auth' => Auth::check(),
            'fixoffers' => $fixoffers,
            'fixerJob' => $fixerJob,
            'requesterJob' => $requesterJob,
            'hasMadeFixOffer' => $hasMadeFixOffer,
            'related' => $related,
        ));
    }
	
    public function getSearch($sort=null, $filter=null)
    {
        $terms = Session::get('fixrequest_terms');
        $local = Session::get('fixrequest_local');

		$requests_per_page = 6;
        if ($sort == "recent") {
            $fixrequests = FixRequest::recent_requests_search($terms, $local, $filter)->paginate($requests_per_page);
			Session::put('sort', "recent");
        } else if ($sort == 'popular') {
            $fixrequests = FixRequest::popular_requests_search($terms, $local, $filter)->paginate($requests_per_page);
			Session::put('sort', "popular");
        } else if ($sort == 'no_offers') {
            $fixrequests = FixRequest::no_offers_requests_search($terms, $local, $filter)->paginate($requests_per_page); 
			Session::put('sort', "no_offers");
        } else if ($sort == 'ending_soon') {
            $fixrequests = FixRequest::ending_soon_requests_search($terms, $local, $filter)->paginate($requests_per_page); 
			Session::put('sort', "ending_soon");
        } else if ($sort == 'in_progress') {
            $fixrequests = FixRequest::in_progress_requests_search($terms, $local, $filter)->paginate($requests_per_page); 
			Session::put('sort', "in_progress");
        } else {
            return Redirect::to('fixrequests/search/recent');
        }

        $popular_tags = Tag::getPopular(10);
        foreach($fixrequests as &$fixrequest) {
            $post = Post::find($fixrequest['post_id']);
            $user = User::find($post['user_id']);
            $fixrequest['text'] = UtilFunctions::truncateString($post['text'], 220);
            $fixrequest['user_id'] = $post['user_id'];
            $fixrequest['username'] = $user['username'];
            $fixrequest['user_image'] = $user['user_image'];
            $fixrequest['created_at_pretty'] = UtilFunctions::prettyDate($fixrequest['created_at']);
            $fixrequest['category'] = $fixrequest->category;
            $fixrequest['category_class'] = UtilFunctions::getCategoryIdWord($fixrequest->category['id']);
            $fixrequest['end_date_exact'] = date("Y-m-d H:i:s", strtotime($fixrequest->created_at." + $fixrequest->daysForOffer days"));
            $fixrequest['end_date'] = UtilFunctions::getEndDate($fixrequest['created_at'], $fixrequest['daysForOffer']);
        }

        return View::make('fixrequests.search', array(
            "fixrequests" => $fixrequests,
            "sort" => $sort,
            "popular_tags" => $popular_tags,
            "text" => $terms,
            "district" => $local,
            "filter" => $filter,
        ));
	}
    
    public function postSearch()
    {
        Session::put('fixrequest_terms', Input::get('text'));
        Session::put('fixrequest_local', Input::get('district'));
        return $this->getSearch(Session::get('sort'));
    }

    /**
     * Show the form for creating a fix request
     *
     * @return Response
     */
    public function getCreate()
    {
        if(Auth::check()) {
            return View::make('fixrequests.create');
        } else {
            Session::flash('error', 'You have to login to be able to make a fix request');
            return Redirect::guest('users/login');
        }
    }

    /**
    * Deal with the info sent from the fix request creation form
    *
    * @return Redirect
    */

    public function postCreate() 
    {
        $rules = array(
            'title' => 'required|min:4',
            'category' => 'required|in:1,2,3,4,5',
            'description' => 'required|min:20',
            'tags' => 'required',
            'city' => 'required',
            'location' => 'required',
            'daysForOffer' => 'required|numeric',
            'value' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {
            $redirect = DB::transaction(function()
            {
                $notifiable = new Notifiable();
                $notifiable->save();

                $post = new Post(array(
                    "text" => Input::get('description'),
                    "user_id" => Auth::user()->id
                ));
                $post = $notifiable->post()->save($post);

                $fixrequest = new FixRequest(array(
                    'title' => Input::get('title'),
                    'state' => 'active',
                    'daysForOffer' => Input::get('daysForOffer'),
                    'value' => Input::get('value'),
                    'city' => ucfirst(strtolower(Input::get('city'))),
                    'concelho' => ucfirst(strtolower(Input::get('location')))
                ));

                $category = Category::find(Input::get('category'));
                $fixrequest->category()->associate($category);
                $fixrequest = $post->fixrequest()->save($fixrequest);

                $tag_list = explode(",", Input::get('tags'));
                foreach($tag_list as $tag_name) {
                    $tag = null;

                    if(!Tag::exists($tag_name)) {
                        $tag = new Tag(array("name" => $tag_name));
                        $tag->save();
                    } else {
                        $tag = Tag::getTagByName($tag_name);
                    }
                    $fixrequest->tags()->save($tag);
                }

                // dealing with the photos received
                $photos = Input::file('photos');

                foreach($photos as $up_photo) {
                    if(!is_null($up_photo)) {
                        $rules = array('photo' => 'image|max:3000');
                        $input = array('photo' => $up_photo);

                        $validator = Validator::make($input, $rules);

                        if($validator->passes()) {
                            $destinationPath = 'uploads/'.Auth::user()->id.'/'.$post->id;
                            $filename = str_random(8).'.'.$up_photo->getClientOriginalExtension();
                            $up_photo->move($destinationPath, $filename);

                            $photo = new Photo(array('path' => $destinationPath.'/'.$filename));
                            $photo = $post->photos()->save($photo);
                        } else {
                            return Redirect::to('fixrequests/create')->withInput()->withErrors($validator);
                        }  
                    }
                }
                return Redirect::to("fixrequests/show/{$fixrequest->id}");
            });
            return $redirect;
        } else {
            return Redirect::to('fixrequests/create')->withInput()->withErrors($validator);
        }
    }

    function blockFixrequest($idFixrequest)
    {
        $fixrequest=FixRequest::getFixRequest($idFixrequest);
        $post=$fixrequest['post'];
        //Email::sendNotificationEmail('mainstopable@gmail.com','novo post!');
        var_dump($post);
        die;
    }

    function deleteFixrequest($idFixrequest)
    {
        $fixrequest=FixRequest::getFixRequest($idFixrequest);
        $post=$fixrequest['post'];
        var_dump($post);
        die;   
    }

    function unblockFixrequest($idFixrequest)
    {
        $fixrequest=FixRequest::getFixRequest($idFixrequest);
        $post=$fixrequest['post'];
        var_dump($post);
        die;   
    }
}