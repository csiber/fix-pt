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
            'city' => 'required',
            'location' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {

            DB::transaction(function()
            {
                $notifiable = new Notifiable();
                $notifiable->save();

                $post = new Post(array(
                    "text" => Input::get('body'), 
                    "user_id" => 1
                ));
                $post = $notifiable->post()->save($post);

                $promotionpage = new PromotionPage(array(
                    'title' => Input::get('title')
                ));

                $category = Category::find(Input::get('category'));
                $promotionpage->category()->associate($category);
                $promotionpage = $post->promotionpage()->save($promotionpage);
                 
            });
            return Redirect::to('promotionpages/index');
        } else {
            return Redirect::to('promotionpages/create')->withInput()->withErrors($validator);
        }
    }
}