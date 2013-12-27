<?php

class CommentController extends BaseController {

    /**
    * creates a new comment
    */
    public function postCreate()
    {
        $rules = array(
            'text' => 'required|min:1',
            'fix_request_id' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {

            $fixrequest = FixRequest::find(Input::get('fix_request_id'));

            if($fixrequest) {
                $comment = DB::transaction(function() {
                    $notifiable = new Notifiable();
                    $notifiable->save();

                    $post = new Post(array(
                        'text' => Input::get('text'),
                        'user_id' => Auth::user()->id
                    ));

                    $post = $notifiable->post()->save($post);

                    $comment = new Comment(array(
                        'fix_request_id' => Input::get('fix_request_id'),
                        'post_id' => $post->id
                    ));
                    $comment->save();
                    return $comment;
                });

                if($comment) {
                    $result = array(
                        'comment_id' => $comment->id,
                        'username' => $comment->post->user->username,
                        'text' => $comment->post->text,
                        'gravatar' => UtilFunctions::gravatar(Auth::user()->email),
                        'created_at_pretty' => UtilFunctions::prettyDate($comment->post->created_at)
                    );
                    return Response::json(array('result' => 'OK', 'comment' => $result));
                }
            }

            return Response::json(array(
                'result' => 'NOK',
                'error_code' => 2,
            ));

        } else {
            return Response::json(array(
                'result' => 'NOK',
                'error_code' => 1,
                'text' => $validator->messages()->first('text'),
                'fix_request_id' => $validator->messages()->first('fix_request_id')
            ));
        }
    }
}