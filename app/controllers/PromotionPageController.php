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

    public function postCreate() {

        var_dump(Input::all());die();
        return View::make('promotionpages.create');
    }

}