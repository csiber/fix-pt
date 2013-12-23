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
                        "fixer_id" => Input::get('fixer_id'),
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
                        "fixer_id" => Input::get('fixer_id'),
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

    public function postRate()
    {
        $rules = array(
            'job_id' => 'required|numeric',
            'feedback' => 'required|min:1',
            'score' => 'required|numeric|in:1,2,3,4,5',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->passes()) {

            $job = Job::find(Input::get('job_id'));

            if($job) {
                $job->feedback = Input::get('feedback');
                $job->score = Input::get('score');
                $job->rated = true;
                $job->save();

                return Response::json(array('result' => 'OK', 'job' => $job));
            }

            return Response::json(array(
                'result' => 'NOK',
                'error_code' => 2,
            ));

        } else {
            return Response::json(array(
                'result' => 'NOK',
                'error_code' => 1,
                'job_id' => $validator->messages()->first('job_id'),
                'feedback' => $validator->messages()->first('feedback'),
                'score' => $validator->messages()->first('score')
            ));
        }
    }
}