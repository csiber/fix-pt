<?php

class JobController extends BaseController {

    /**
    * creates a new comment
    */
    public function postCreate()
    {
        $rules = array(
            'fix_request_id' => 'required|numeric',
            'fixer_id' => 'required|numeric',
            'fix_offer_id' => 'required|numeric',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {
            $fixrequest = FixRequest::find(Input::get('fix_request_id'));
            $fixoffer = FixOffer::find(Input::get('fix_offer_id'));

            if($fixrequest && $fixoffer) {

                // creates a job for the fixer
                $fixerJob = DB::transaction(function(){
                    $notifiable = new Notifiable();
                    $notifiable->save();

                    $job = new Job(array(
                        "fix_request_id" => Input::get('fix_request_id'),
                        "user_id" => Input::get('fixer_id'),
                        "fix_offer_id" => Input::get('fix_offer_id'),
                    ));

                    $job = $notifiable->post()->save($job);
                    return $job;
                });

                // creates a job for the requester
                $requesterJob = DB::transaction(function() use ($fixrequest) {
                    $notifiable = new Notifiable();
                    $notifiable->save();

                    $job = new Job(array(
                        "fix_request_id" => Input::get('fix_request_id'),
                        "fix_offer_id" => Input::get('fix_offer_id'),
                        'user_id' => Auth::user()->id,
                    ));

                    $job = $notifiable->post()->save($job);
                    return $job;
                });

                if($fixerJob && $requesterJob) {
                    $result = array(
                        'job_id' => $fixerJob->id,
                        'username' => $fixerJob->fixer->username,
                        'gravatar' => UtilFunctions::gravatar(Auth::user()->email),
                        'created_at_pretty' => UtilFunctions::prettyDate($fixerJob->notifiable->created_at)
                    );
                    return Response::json(array('result' => 'OK', 'job' => $result));
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
                'fix_request_id' => $validator->messages()->first('fix_request_id'),
                'fixer_id' => $validator->messages()->first('fixer_id'),
                'fix_offer_id' => $validator->messages()->first('fix_offer_id')
            ));
        }
    }
}