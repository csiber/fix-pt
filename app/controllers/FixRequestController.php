<?php

class FixRequestController extends BaseController {

    /**
    * Display a listing of fix requests
    *
    * @return Response
    */
    public function getIndex($sort=null)
    {
        $requests_per_page = 5;

        if ($sort == "recent") {
            $fixrequests = FixRequest::recent_requests()->paginate($requests_per_page);
        } else if ($sort == 'popular') {
            $fixrequests = FixRequest::popular_requests()->paginate($requests_per_page);
        } else if ($sort == 'no_offers') {
            $fixrequests = FixRequest::no_offers_requests()->paginate($requests_per_page); 
        } else if ($sort == 'ending_soon') {
            $fixrequests = FixRequest::ending_soon_requests()->paginate($requests_per_page); 
        } else {
            return Redirect::to('fixrequests/index/recent');
        }

        $popular_tags = Tag::getPopular(20);

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

        return View::make('fixrequests.index', array(
            'fixrequests' => $fixrequests,
            "sort" => $sort,
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
        $fixrequest['created_at_pretty'] = UtilFunctions::prettyDate($fixrequest['created_at']);
        $fixrequest['post']->text = nl2br((stripslashes($fixrequest['post']->text)));
        
        $comments = Comment::getCommentsOfFixRequest($id);

        foreach($comments as &$comment) {
            $comment['created_at_pretty'] = UtilFunctions::prettyDate($comment['created_at']);
            $comment['gravatar'] = "http://www.gravatar.com/avatar/".md5(strtolower(trim($comment->post->user->email)))."?s=48&r=pg&d=identicon";
        }

        return View::make('fixrequests/show', array(
            'fixrequest' => $fixrequest,
            'comments' => $comments,
            'photos' => $fixrequest->post->photos()->getResults(),
            'auth' => Auth::check(),
            'fixoffers' => array(), // TODO
        ));
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
                    'value' => Input::get('value')
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
        
        //$data = Input::all();

        // return Input::file('photos')->getClientOriginalName();
        // $file = Input::file('photos');

        //echo json_encode($data);
        //var_dump($file->getFileName());
    }

    public function addComment()
    {

        $redirect = DB::transaction(function(){
            $text = Input::get('comment');
            $userId = Auth::user()->id;
            $fix_request_id = Input::get('fixrequest-id');
            
            $notifiable = new Notifiable();
            $notifiable->save();
            $post = new Post(array(
                        "text" => $text,
                        "user_id" => $userId
                    ));
            $post = $notifiable->post()->save($post);
            
            $comment = new Comment(array("fix_request_id" => $fix_request_id, 
                                         "post_id" => $post->id));
            $comment->save();

            $fixrequest = FixRequest::getFixRequest($fix_request_id);
            $fixrequest['created_at_pretty'] = UtilFunctions::prettyDate($fixrequest['created_at']);

            return Redirect::to('fixrequests/show/' . $fix_request_id);
        });
        return $redirect;
    }
}