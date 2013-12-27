<?php

class PromotionPageController extends BaseController {

    /**
    * Display a listing of promotion pages
    *
    * @return Response
    */
    public function getIndex($sort=null, $filter=null)
    {   
        $terms = Session::get('terms');
        $local = Session::get('local');

        $requests_per_page = 5;


        if ($sort == 'recent') {
            $promotionpages = PromotionPage::recent_promotion_pages($terms,$local,$filter)->paginate($requests_per_page);
			Session::put('sort', 'recent');
        } else if ($sort == 'popular') {
            $promotionpages = PromotionPage::popular_promotion_pages($terms,$local,$filter)->paginate($requests_per_page);
			Session::put('sort', 'popular');
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

		$bestfixers = PromotionPage::getBestFixers();
		foreach($bestfixers as &$bestf)
        {
		   $user_fixer = User::find($bestf['fixer_id']);
		   $bestf['username'] = $user_fixer['username'];
           $bestf['gravatar'] = UtilFunctions::gravatar($user_fixer['email'], 30);
           $bestf['id'] = $user_fixer['id'];
           $bestf['rating'] = round($bestf['rating'], 2);
        }

        return View::make('promotionpages.index', array(
            'promotionpages' => $promotionpages,
            "sort" => $sort,
            "filter" => $filter,
            "district" => $local,
            "text" => $terms,
            "best_fixers" => $bestfixers
        ));
    }
    
    public function postIndex()
    {
        Session::put('terms', Input::get('text'));
        Session::put('local', Input::get('district'));
        return $this->getIndex(Session::get('sort'));
    }

    /**
    * Displays a single promotion page
    *
    * @return Response
    */
    public function getShow($id)
    {
        $promotionpage = PromotionPage::getPromotionPage($id);
        $isFavorite = false;

        if(! $promotionpage) {
            App::abort(404, 'Article not found');
        }

        if(Auth::check()){
            $isFavorite = Favorite::checkFavorite($promotionpage->post->user->id);
        }

        $promotionpage['created_at_pretty'] = UtilFunctions::prettyDate($promotionpage['created_at']);
        $promotionpage->post['text'] = trim(nl2br(stripslashes($promotionpage->post['text'])));

        return View::make('promotionpages.show',
            array('promotionpage' => $promotionpage,
                'photos' => $promotionpage->post->photos()->getResults(),
                'gravatar' => UtilFunctions::gravatar($promotionpage->post->user->email),
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

    public function getEdit() {
            $promotionpage = PromotionPage::getPromotionPageNoId();
            return View::make('promotionpages.edit', 
                array( 'promotionpage'=>$promotionpage[0]));
    }

    public $editRules = array(
        'title' => 'required|min:8',
        'body' => 'required|min:1'
    );

    public function postEdit() {

        $validator = Validator::make(Input::all(), $this->editRules);

        if ($validator->fails()) {
            return Redirect::to('promotionpages/edit/')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            $id1 = Auth::user()->id;
            
            $id = PromotionPage::getPromotionPageID();
            
            $promotionpage = PromotionPage::find($id[0]->id);

            if (Input::get('title') != null && Input::get('body') != null) {
                $promotionpage->title = Input::get('title');
                $promotionpage->post->text = Input::get('body');
                $promotionpage->category_id = Input::get('category');
            }

            $promotionpage->save();
            $promotionpage->post->save();
            // TODO is this final?
            $msg = 'Your promotion page was successfully updated!';

            $photos = Input::file('photos');

            foreach($photos as $up_photo) {
                if(!is_null($up_photo)) {
                    $rules = array('photo' => 'image|max:3000');
                    $input = array('photo' => $up_photo);

                    $validator = Validator::make($input, $rules);

                    if($validator->passes()) {
                        $destinationPath = 'uploads/promotionpages/'.Auth::user()->id.'/'.$promotionpage->post->id;
                        $filename = str_random(8).'.'.$up_photo->getClientOriginalExtension();
                        $up_photo->move($destinationPath, $filename);

                        $photo = new Photo(array('path' => $destinationPath.'/'.$filename));
                        $photo = $promotionpage->post->photos()->save($photo);
                    } else {
                        return Redirect::to('promotionpage/edit')->withInput()->withErrors($validator);
                    }  
                }
            }

            Session::flash('success', $msg);
            return Redirect::to("promotionpages/show/" . $promotionpage->id);
        }
    }

    public function postCreate() 
    {
        $rules = array(
            'title' => 'required|min:4',
            'category' => 'required|in:1,2,3,4,5',
            'body' => 'required|min:1',
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
                    "text" => trim(nl2br(Input::get('body'))), 
                    "user_id" => Auth::user()->id
                ));
                $post = $notifiable->post()->save($post);

                $promotionpage = new PromotionPage(array(
                    'title' => Input::get('title'),
                    'city' => ucfirst(strtolower(Input::get('city'))),
                    'concelho' => ucfirst(strtolower(Input::get('location')))
                ));

                $category = Category::find(Input::get('category'));
                $promotionpage->category()->associate($category);
                $promotionpage = $post->promotionpage()->save($promotionpage);

                $photos = Input::file('photos');

                foreach($photos as $up_photo) {
                    if(!is_null($up_photo)) {
                        $rules = array('photo' => 'image|max:3000');
                        $input = array('photo' => $up_photo);

                        $validator = Validator::make($input, $rules);

                        if($validator->passes()) {
                            $destinationPath = 'uploads/promotionpages/'.Auth::user()->id.'/'.$post->id;
                            $filename = str_random(8).'.'.$up_photo->getClientOriginalExtension();
                            $up_photo->move($destinationPath, $filename);

                            $photo = new Photo(array('path' => $destinationPath.'/'.$filename));
                            $photo = $post->photos()->save($photo);
                        } else {
                            return Redirect::to('promotionpage/create')->withInput()->withErrors($validator);
                        }  
                    }
                }

                $promotionPage = PromotionPage::isTherePromotionPage();
                Session::put('haspromotionpage', $promotionPage);

                return Redirect::to("promotionpages/show/{$promotionpage->id}"); 
            });
            return $redirect;
        } else {
            return Redirect::to('promotionpages/create')->withInput()->withErrors($validator);
        }
    }
}