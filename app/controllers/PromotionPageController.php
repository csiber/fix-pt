<?php

class PromotionPageController extends BaseController {

    /**
    * Display a listing of promotion pages
    *
    * @return Response
    */
    public function getIndex($sort=null)
    {   
        $requests_per_page = 5;

        if ($sort == "recent") {
            $promotionpages = PromotionPage::orderBy('created_at', 'DESC')->paginate(5);
        } else {
            return Redirect::to('promotionpages/index/recent');
        }

        foreach($promotionpages as $promotionpage) {
            $post = Post::find($promotionpage['post_id']);
            $user = User::find($post['user_id']);
            
            $promotionpage['body'] = UtilFunctions::truncateString($post['text'], 220);
            $promotionpage['user_id'] = $post['user_id'];
            $promotionpage['username'] = $user['username'];
            $promotionpage['user_image'] = $user['user_image'];
            $promotionpage['created_at_pretty'] = UtilFunctions::prettyDate($promotionpage['created_at']);
            $promotionpage['category'] = $promotionpage->category;
            $promotionpage['category_class'] = UtilFunctions::getCategoryIdWord($promotionpage->category['id']);
        }
        return View::make('promotionpages.index', array('promotionpages' => $promotionpages, "sort" => $sort));
    }

    /**
    * Displays a single promotion page
    *
    * @return Response
    */
    public function getShow($id)
    {
        $promotionpage = PromotionPage::getPromotionPage($id);
        $user2 = $promotionpage->post->user->id;
        $user1 = Auth::user()->id;
        $isFavorite = Favorite::checkFavorite($user1, $user2);
        return View::make('promotionpages.show',
            array('promotionpage' => $promotionpage,
            'favorite' => $isFavorite)
        );
    }

    /**
     * Show the form for creating a fix request
     *
     * @return Response
     */
    public function getCreate()
    {
        if(Auth::check()){
            return View::make('promotionpages.create');
        } else {
            Session::flash('error', 'You have to login to be able to make a promotion page');
            return Redirect::guest('users/login');
        }
    }

    public function postCreate() 
    {
        $rules = array(
            'title' => 'required|min:4',
            'category' => 'required|in:1,2,3,4,5',
            'body' => 'required|min:20',
            'city' => 'required',
            'location' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {
            $redirect = DB::transaction(function()
            {
                $notifiable = new Notifiable();
                $notifiable->save();

                $post = new Post(array(
                    "text" => Input::get('body'), 
                    "user_id" => Auth::user()->id
                ));
                $post = $notifiable->post()->save($post);

                $promotionpage = new PromotionPage(array(
                    'title' => Input::get('title')
                ));

                $category = Category::find(Input::get('category'));
                $promotionpage->category()->associate($category);
                $promotionpage = $post->promotionpage()->save($promotionpage);
                return Redirect::to("promotionpages/show/{$promotionpage->id}"); 
            });
            return $redirect;
        } else {
            return Redirect::to('promotionpages/create')->withInput()->withErrors($validator);
        }
    }
}