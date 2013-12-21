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
        <div class="well well-lg fix-offers">
            <h4 class="lead"><span class="counter">{{count($fixoffers)}}</span> Fix Offers</h4>
            <div class="fixoffers-list">
                @foreach($fixoffers as $fixoffer)
                <ul class="media-list fixoffer">
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
        <div class="well well-lg comments">
            <h4 class="lead"><span class="counter">{{count($comments)}}</span> Comments</h4>
            
            @if(count($comments) > 0)
                @if(count($comments) > 5)
                    <a class="showAllComments"> show more... </a>
                @endif
            <div class="comment-list">
                <?php $myId=0; ?>
                @foreach($comments as $comment)
                    @if(count($comments)>5 && $myId<(count($comments)-5))
                    <ul class="media-list comment" style="display:none">
                    @else
                    <ul class="media-list comment">    
                    @endif
                    
                      <li class="media">
                        <a class="pull-left" href="#">
                          <img class="media-object" src="{{$comment['gravatar']}}" alt="...">
                        </a>
                        <div class="media-body">
                          <h5 class="media-heading"><a href="#">{{{$comment->post->user->username}}}</a><span> - {{$comment->created_at_pretty}}</span></h5>
                          {{{$comment['post']->text}}}
                        </div>
                      </li>
                    </ul>
                    <?php $myId++; ?>
                @endforeach
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title lead">Recommended Fixers</h3>
            </div>
            <div class="panel-body">
                This will show fixers that are able to do this repair
            </div>
        </div>
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

