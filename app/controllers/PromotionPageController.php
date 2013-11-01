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

    /**
    * Displays a single promotion page
    *
    * @return Response
    */
    public function getShow($id)
    {
        $promotion_page = PromotionPage::find($id);
        return View::make('promotionpages.show',
            array('promotion_pages' => $fixrequest, 'id' => $id)
        );
    }

    /**
     * Show the form for creating a fix request
     *
     * @return Response
     */
    public function getCreate()
    {
        return View::make('promotionpages.create');
    }

    public function postCreate() 
    {
        $rules = array(
            'title' => 'required|min:4',
            'body' => 'required|min:20',
            'city' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {

            DB::transaction(function()
            {
                $notifiable = new Notifiable();
                $notifiable->save();

                $post = new Post();
                $fixrequest = new PromotionPage();

                $post->body = Input::get('body');
                $post->save();

                $fixrequest->post_id = $post->id;
                $fixrequest->title = Input::get("title");
                $fixrequest->save();                             
            });

            $fix_request = array(
                'title' => Input::get("title"),
                'body' => Input::get("body"),
                'city' => Input::get('city')
            );

            echo json_encode($fix_request);
        } else {
            var_dump($validator->errors()->all());
            return Redirect::to('promotionpages/create')->withInput()->withErrors($validator);
        }        
    }
}