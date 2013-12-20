<?php

class FixOfferController extends BaseController {

    public function fixrequest()
    {
        $this->belongsTo('FixRequest');
    }

    public function postCreate()
    {
        $rules = array(
            'text' => 'required|min:20',
            'value' => 'required|numeric',
            'fix_request_id' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {

            $fixrequest = FixRequest::find(Input::get('fix_request_id'));

            if($fixrequest) {

                // neesd to check that the fix request isn't his
                if($fixrequest->post->user->id != Auth::user()->id) {

                    // needs to see if the user already has a fix offer in this fix request

                    // creates the fix offer
                    $fixoffer = DB::transaction(function() {
                        $notifiable = new Notifiable();
                        $notifiable->save();

                        $post = new Post(array(
                            'text' => Input::get('text'),
                            'user_id' => Auth::user()->id
                        ));

                        $post = $notifiable->post()->save($post);

                        $fixoffer = new FixOffer(array(
                            'fix_request_id' => Input::get('fix_request_id'),
                            'post_id' => $post->id,
                            'value' => Input::get('value')
                        ));
                        $fixoffer->save();

                        Email::sendNotificationEmail($fixrequest->post->user->email,'Tem uma nova oferta!');

                        return $fixoffer;
                    });

                    if($fixoffer) {
                        $result = array(
                            'fix_offer_id' => $fixoffer->id,
                            'username' => $fixoffer->post->user->username,
                            'text' => $fixoffer->post->text,
                            'gravatar' => "http://www.gravatar.com/avatar/".md5(strtolower(trim(Auth::user()->email)))."?s=48&r=pg&d=identicon",
                            'created_at_pretty' => UtilFunctions::prettyDate($fixoffer->post->created_at)
                        );
                        return Response::json(array('result' => 'OK', 'error_code' => 0, 'fixoffer' => $result));
                    } else {
                        return Response::json(array('result' => 'NOK', 'error_code' => 4, 'error' => "Something went wrong while saving fix offer in our database"));
                    }
                } else {
                    return Response::json(array('result' => 'NOK', 'error_code' => 3, 'error' => "You can't make offers to your own fix request"));
                }
            } else {
                return Response::json(array('result' => 'NOK', 'error_code' => 2, 'error' => 'No fix request with that id'));
            }

        } else {
            return Response::json(array(
                'result' => 'NOK',
                'error_code' => 1,
                'text' => $validator->messages()->first('text'),
                'value' => $validator->messages()->first('value'),
                'fix_request_id' => $validator->messages()->first('fix_request_id')
            ));
        }
    }
}