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
            $fixrequest = new FixRequest();
            $fixrequest->title = Input::get("title");
            $fixrequest->state = "active";
            $fixrequest->save();

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