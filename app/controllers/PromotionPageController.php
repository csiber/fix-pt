<?php

class PromotionPageController extends BaseController {

    /**
    * Display a listing of promotion pages
    *
    * @return Response
    */
    public function getIndex()
    {
        $promotion_pages = PromotionPage::all();
        return View::make('promotionpages.index', array('promotion_pages' => $promotion_pages));
    }

     public function getCreate() {
        return View::make('promotionpages.create');
    }

    public function postCreate() 
    {
        $rules = array(
            'title' => 'required|min:4',
            'body' => 'required|min:20',
            'location' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {
            $promotionpage = new FixRequest();
            $promotionpage->title = Input::get("title");
            //$promotionpage->state = "active"; ??? É PRECISO ???
            $promotionpage->save();

            $promotion_page = array(
                'title' => Input::get("title"),
                'body' => Input::get("body"),
                'location' => Input::get("location")
            );

            echo json_encode($promotion_page);
        } else {
            return Redirect::to('promotionpages/create')->withInput()->withErrors($validator);
        }
        
        //$data = Input::all();

        // return Input::file('photos')->getClientOriginalName();
        // $file = Input::file('photos');

        //echo json_encode($data);
        //var_dump($file->getFileName());
    }
}