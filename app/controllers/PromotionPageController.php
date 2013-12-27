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
        $isFavorite = false;
        if(Auth::check()){
            $isFavorite = Favorite::checkFavorite($user2);
        }
        return View::make('promotionpages.show',
            array('promotionpage' => $promotionpage,
                'photos' => $promotionpage->post->photos()->getResults(),
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
            return View::make('promotionpages.edit', array('promotionpage'=>$promotionpage[0]));
    }

    public $editRules = array(
        'title' => 'required|min:8',
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
                        $destinationPath = 'uploads/'.Auth::user()->id.'/'.$promotionpage->post->id;
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

                $photos = Input::file('photos');

                foreach($photos as $up_photo) {
                    if(!is_null($up_photo)) {
                        $rules = array('photo' => 'image|max:3000');
                        $input = array('photo' => $up_photo);

                        $validator = Validator::make($input, $rules);

                        if($validator->passes()) {
                            $destinationPath = 'uploads/'.Auth::user()->id.'/'.$post->id;
                            $filename = str_random(8).'.'.$up_photo->getClientOriginalExtension();
                            $up_photo->move($destinationPath, $filename);

                            $photo = new Photo(array('path' => $destinationPath.'/'.$filename));
                            $photo = $post->photos()->save($photo);
                        } else {
                            return Redirect::to('promotionpage/create')->withInput()->withErrors($validator);
                        }  
                    }
                }

                return Redirect::to("promotionpages/show/{$promotionpage->id}"); 
            });
            return $redirect;
        } else {
            return Redirect::to('promotionpages/create')->withInput()->withErrors($validator);
        }
    }
}