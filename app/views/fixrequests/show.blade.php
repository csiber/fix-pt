@extends('fixrequests/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('fixrequests/index/recent')}}">Fix Requests</a></li>
            <li class="active">{{{$fixrequest->title}}}</li>
        </ol>
        <div class="well well-lg fixrequest" data-fix-request-id="{{$fixrequest->id}}">
            <h4 class="lead">{{{$fixrequest->title}}} <span class="tag pull-right label">{{$fixrequest->category->name}}</span></h4>
            <p>{{$fixrequest['post']->text}}</p>
            
            @if(count($photos) > 0)
                <h5>Photos (click to enlarge)</h5>
                <ul class="photo-list">
                    @foreach($photos as $photo)
                    <li><a class="fancybox" rel="gallery1" href="{{URL::to(''.$photo->path)}}"><img src="{{URL::to(''.$photo->path)}}" alt="" /></a></li>
                    @endforeach
                </ul>
            @endif

            <div class="fixrequest-author text-right">requested by <a href="{{ URL::to('users/show/'.$fixrequest->post->user_id) }}">{{{$fixrequest->post->user->username}}}</a></div>
            @if(Auth::user() && Auth::user()->user_type == 'Moderator')
                <button type="button" onclick="window.location.href='../../fixrequests/blockfixrequest/{{$fixrequest->id}}'" class="btn btn-success">Block post</button>
                            
            @endif
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="well well-lg stats">
                    <h2 class="lead">{{{$fixrequest->value}}}€</h2>
                    <span>value</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="well well-lg stats">
                    <h2 class="lead">{{{$fixrequest->created_at_pretty}}}</h2>
                    <span>posted</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="well well-lg stats">
                    <h2 class="lead">{{{$fixrequest->end_date}}}</h2>
                    <span>time left</span>
                </div>
            </div>
        </div>

        @if(Auth::user())

            @if(Auth::user()->id == $fixrequest->post->user_id && $requesterJob && !$requesterJob->rated)
                <div class="well well-lg job" data-job-id="{{$requesterJob->id}}">
                    <h4 class="lead">Rate the job done by the fixer</h4>
                    <form id="give_rating_form" action="#">
                        <h5>Feedback</h5>
                        <div class="form-group">
                            <textarea name="rating_text" id="" rows="3" class="form-control"></textarea>
                        </div>
                        <h5>Rating</h5>
                        <div class="form-group">
                            <input type="number" name="job_rating" data-max="5" data-min="1" class="rating" />
                        </div>
                        <button type="button" class="btn btn-success btn-sqr">Submit</button>
                    </form>
                </div>
            @endif

            @if($requesterJob && $requesterJob->rated)
                @if(Auth::user()->id == $fixrequest->post->user_id)
                    <div class="well well-lg">
                        <h4 class="lead">You gave the following rating to <a href="{{ URL::to('users/show/'.$fixrequest->post->user_id) }}">{{$requesterJob->fixer->username}}</a></h4>
                        <p>{{{$requesterJob->feedback}}}</p>
                        <div>
                            @for($i = 0; $i < $requesterJob->score; $i++)
                                <i class='glyphicon glyphicon-star'></i>
                            @endfor
                        </div>
                    </div>
                @elseif(Auth::user()->id == $requesterJob->fixer_id)
                    <div class="well well-lg">
                        <h4 class="lead">You received the following rating for this job</h4>
                        <p>{{{$requesterJob->feedback}}}</p>
                        <div>
                            @for($i = 0; $i < $requesterJob->score; $i++)
                                <i class='glyphicon glyphicon-star'></i>
                            @endfor
                        </div>
                    </div>
                @else
                    <div class="well well-lg">
                        <h4 class="lead"><a href="#">{{{$fixrequest->post->user->username}}}</a> gave the following rating to <a href="#">{{$requesterJob->fixer->username}}</a></h4>
                        <p>{{{$requesterJob->feedback}}}</p>
                        <div>
                            @for($i = 0; $i < $requesterJob->score; $i++)
                                <i class='glyphicon glyphicon-star'></i>
                            @endfor
                        </div>
                    </div>
                @endif
            @endif

            @if($fixerJob && $fixerJob->rated)
                @if(Auth::user()->id == $fixrequest->post->user_id)
                    <div class="well well-lg">
                        <h4 class="lead">You received the following rating for this job from <a href="#">{{$fixerJob->user->username}}</a></h4>
                        <p>{{{$fixerJob->feedback}}}</p>
                        <div>
                            @for($i = 0; $i < $fixerJob->score; $i++)
                                <i class='glyphicon glyphicon-star'></i>
                            @endfor
                        </div>
                    </div>
                @elseif(Auth::user()->id == $fixerJob->fixer_id)
                    <div class="well well-lg">
                        <h4 class="lead">You gave the following rating for this job</h4>
                        <p>{{{$fixerJob->feedback}}}</p>
                        <div>
                            @for($i = 0; $i < $fixerJob->score; $i++)
                                <i class='glyphicon glyphicon-star'></i>
                            @endfor
                        </div>
                    </div>
                @else
                    <div class="well well-lg">
                        <h4 class="lead"><a href="#">{{$fixerJob->user->username}}</a> gave the following rating to <a href="#">{{{$fixrequest->post->user->username}}}</a></h4>
                        <p>{{{$fixerJob->feedback}}}</p>
                        <div>
                            @for($i = 0; $i < $fixerJob->score; $i++)
                                <i class='glyphicon glyphicon-star'></i>
                            @endfor
                        </div>
                    </div>
                @endif
            @endif
        
            @if($fixerJob && Auth::user()->id == $fixerJob->user_id && !$fixerJob->rated)
                <div class="well well-lg job" data-job-id="{{$fixerJob->id}}">
                    <h4 class="lead">Rate this requester</h4>
                    <form id="give_rating_form" action="#">
                        <h5>Feedback</h5>
                        <div class="form-group">
                            <textarea name="rating_text" id="" rows="3" class="form-control"></textarea>
                        </div>
                        <h5>Rating</h5>
                        <div class="form-group">
                            <input type="number" name="job_rating" data-max="5" data-min="1" class="rating" />
                        </div>
                        <button type="button" class="btn btn-success btn-sqr">Submit</button>
                    </form>
                </div>
            @endif

            @if(Auth::user()->id != $fixrequest->post->user_id && $requesterJob && !$requesterJob->rated && Auth::user()->id != $fixerJob->user_id)
                <div class="well well-lg text-center">
                    <span class="label brand-bc accepted-warning">The requester has accepted an offer</span>
                </div>
            @endif

            <div class="well well-lg fix-offers">
                <h4 class="lead"><span class="counter">{{count($fixoffers)}}</span> Fix Offers</h4>
                <div class="fixoffers-list">
                    @foreach($fixoffers as $fixoffer)
                    <ul class="media-list fixoffer @if($fixerJob && $fixerJob->fix_offer_id == $fixoffer->id)accepted@endif" data-fix-offer-id="{{$fixoffer->id}}" data-fixer-id="{{$fixoffer->post->user->id}}">
                        <div class="row">
                            <div class="col-md-9">
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="{{$fixoffer['gravatar']}}" alt="" class="media-object">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading"><a href="#">{{{$fixoffer->post->user->username}}}</a><span> - {{$fixoffer->created_at_pretty}}</span></h5>
                                        {{{$fixoffer['post']->text}}}
                                        <h5>Value: {{$fixoffer->value}}€</h5>
                                    </div>
                                </li>  
                            </div>
                            <div class="col-md-3">
                                @if(Auth::user() && Auth::user()->id == $fixrequest->post->user_id && !$requesterJob)
                                <button class="btn btn-success accept">Accept</button>
                                @endif
                            </div>
                        </div>
                    </ul>
                    @endforeach
                </div>

                @if(Auth::user() && Auth::user()->id != $fixrequest->post->user_id && !$hasMadeFixOffer)
                <form id="create_fix_offer_form" action="#">
                    <h5>Make your offer</h5>
                    <div class="form-group">
                        <textarea name="fix_offer_text" id="" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">€</span>
                            <input type="number" name="value" class="form-control" value="0" min="0">
                        </div>
                        <p class="help-block"><?php echo $errors->first('value') ?></p>
                    </div>
                    <button type="button" class="btn btn-success">Make fix offer</button>
                </form>
                @endif

            </div>
        @else
            @if($requesterJob)
                <div class="well well-lg text-center">
                    <span class="label brand-bc accepted-warning">The requester has accepted an offer</span>
                </div>
            @endif
        @endif

        <div class="well well-lg comments">
            <h4 class="lead"><span class="counter">{{count($comments)}}</span> Comments</h4>

            @if(count($comments) > 0)
                @if(count($comments) > 5)
                    <button type="button" class="btn btn-link show_comments">Show {{count($comments) - 5}} more comments</button>
                @endif
            <div class="comment-list">
                @for ($i = 0; $i < count($comments); $i++)
                    <ul class="media-list comment @if( count($comments) > 5 && $i < count($comments) - 5 )hide@endif">
                        <li class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="{{$comments[$i]['gravatar']}}" alt="...">
                            </a>
                            <div class="media-body">
                                <h5 class="media-heading"><a href="#">{{{$comments[$i]->post->user->username}}}</a><span> - {{$comments[$i]->created_at_pretty}}</span></h5>
                                {{{$comments[$i]->post->text}}}
                            </div>
                        </li>
                    </ul>
                @endfor
            </div>
            @endif

                @if(Auth::user())
                <form id="create_comment_form" action="#">
                    <div class="form-group">
                        <textarea name="comment-text" class="form-control" placeholder="Make a comment." rows="3"></textarea>
                    </div>
                    <button type="button" class="btn btn-success">Add Comment</button>
                </form>
                @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default fix-request-sidestats">
            <div class="panel-heading">
                <h3 class="panel-title lead">Fix Request Stats</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-sm-3 col-lg-4 text-center">
                        <h4>{{$fixrequest->views}}</h4>
                        <span>views</span>
                    </div>
                    <div class="col-md-6 col-sm-3 col-lg-4 text-center">
                        <h4>{{count($fixoffers)}}</h4>
                        <span>fix offers</span>
                    </div>
                    <div class="col-md-12 col-sm-3 col-lg-4 text-center">
                        <h4>{{count($comments)}}</h4>
                        <span>comments</span>
                    </div>
                    <!-- <div class="col-md-12 col-sm-3 col-lg-12">
                        <h4 class="lead">last activity</h4>
                        <span>{{$fixrequest->updated_at_pretty}}</span>
                    </div> -->
                </div>
            </div>
        </div>
        @if(!$requesterJob)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title lead">Recommended Fixers</h3>
            </div>
            <div class="panel-body">
                This will show fixers that are able to do this repair
            </div>
        </div>
        @endif
         <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title lead">Related Fix Requests</h3>
            </div>
            <div class="panel-body">
                This will show fix requests similar to this one
            </div>
        </div>
    </div>
</div>

@stop

