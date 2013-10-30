<?php

class FixRequestController extends BaseController {

    /**
    * Display a listing of fix requests
    *
    * @return Response
    */
    public function getIndex()
    {
        $fixrequests = FixRequest::all();
        return View::make('fixrequests.index', array('fixrequests' => $fixrequests));
    }

    /**
    * Displays a single fix request
    *
    * @return Response
    */
    public function getShow($id)
    {
        $fixrequest = FixRequest::find($id);
        return View::make('fixrequests.show',
            array('fixrequest' => $fixrequest, 'id' => $id)
        );
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

    public function postCreate() 
    {
        $rules = array(
            'title' => 'required|min:4',
            'category' => 'required|in:1,2,3,4',
            'description' => 'required|min:20',
            'tags' => 'required',
            'city' => 'required',
            'daysForOffer' => 'required|numeric',
            'value' => 'required|numeric'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {

            DB::transaction(function()
            {
                $notifiable = new Notifiable();
                $notifiable->save();

                $post = new Post();
                $fixrequest = new FixRequest();

                $post->text = Input::get('description');
                $post->notifiable_id = $notifiable->id;
                $post->user_id = 1;
                $post->save();

                $fixrequest->post_id = $post->id;
                $fixrequest->title = Input::get("title");
                $fixrequest->state = "active";
                $fixrequest->daysForOffer = Input::get('daysForOffer');
                $fixrequest->value = Input::get('value');
                $fixrequest->save();

                $tag_list = explode(",", Input::get('tags'));
                foreach($tag_list as $tag_name) {

                    if (false) {
                    // if(!Tag::exists($tag_name)) {
                        $tag = new Tag();
                        $tag->name = $tag_name;
                        $tag->save();

                        $fixrequesttag = new FixRequestsTag();
                        $fixrequesttag->tag_id = $tag->id;
                        $fixrequesttag->fix_request_id = $fixrequest->id;
                        $fixrequesttag->save();
                    } else {
                        $tag = Tag::getTagByName($tag_name);
                        
                    }
                }
                
            });

            $fix_request = array(
                'title' => Input::get("title"),
                'category' => Input::get("category"),
                'description' => Input::get("description"),
                'tags' => explode(',', Input::get('tags')),
                'city' => Input::get('city'),
                'daysForOffer' => Input::get('daysForOffer'),
                'value' => Input::get('value')
            );

            echo json_encode($fix_request);
        } else {
            var_dump($validator->errors()->all());
            return Redirect::to('fixrequests/create')->withInput()->withErrors($validator);
        }
        
        //$data = Input::all();

        // return Input::file('photos')->getClientOriginalName();
        // $file = Input::file('photos');

        //echo json_encode($data);
        //var_dump($file->getFileName());
    }

    public function comments() 
    {
        return $this->hasMany('Comment');
    }

    public function fixoffers() 
    {
        return $this->hasMany('FixOffer');
    }
}