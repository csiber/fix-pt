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
        } else if ($sort == "popular") {
            $fixrequests = FixRequest::popular_requests()->paginate($requests_per_page);
        } else if ($sort == "no_offers") {
            $fixrequests = FixRequest::no_offers_requests()->paginate($requests_per_page); 
        } else {
            return Redirect::to('fixrequests/index/recent');
        }

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
        }
        return View::make('fixrequests.index', array('fixrequests' => $fixrequests, "sort" => $sort));
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

        return View::make('fixrequests/show', array('fixrequest' => $fixrequest));
    }

    /**
     * Show the form for creating a fix request
     *
     * @return Response
     */
    public function getCreate()
    {
        return View::make('fixrequests.create');
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
            'value' => 'required|numeric'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {
            $redirect = DB::transaction(function()
            {
                $notifiable = new Notifiable();
                $notifiable->save();

                $post = new Post(array(
                    "text" => Input::get('description'),
                    "user_id" => 1
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
}