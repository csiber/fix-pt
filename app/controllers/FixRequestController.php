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
        // handle the creation form
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