<?php

class PostController extends BaseController {

    /**
    * Display a listing of posts
    *
    * @return Response
    */
    public function getIndex()
    {
        $posts = Post::all();
        return View::make('posts.index', array('posts' => $posts));
    }
}