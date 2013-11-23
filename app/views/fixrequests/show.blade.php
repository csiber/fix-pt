@extends('fixrequests/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('fixrequests/index/recent')}}">Fix Requests</a></li>
            <li class="active">{{{$fixrequest->title}}}</li>
        </ol>
        <div class="well well-lg fixrequest">
            <h4>{{{$fixrequest->title}}}</h4>
            <p>{{$fixrequest['post']->text}}</p>
            
            @if(count($photos) > 0)
                <h5>Photos (click to enlarge)</h5>
                <ul class="photo-list">
                    @foreach($photos as $photo)
                    <li><a class="fancybox" rel="gallery1" href="{{URL::to(''.$photo->path)}}"><img src="{{URL::to(''.$photo->path)}}" alt="" /></a></li>
                    @endforeach
                </ul>
            @endif
        
        </div>
        <div class="well well-lg">
            <h4>{{count($fixoffers)}} Fix Offers</h4>
        </div>
        <div class="well well-lg comments">
            <h4>{{count($comments)}} Comments</h4>
            @if(count($comments) > 0)
            <div class="comment-list">
                @foreach($comments as $comment)
                    <ul class="media-list comment">
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
                @endforeach
            </div>
            @endif

                <!-- <ul class="media-list">
                    <li class="media">
                        <a class="pull-left" href="#">
                          <img class="media-object" src="..." alt="...">
                        </a>
                        <div class="media-body">
                            <textarea class="form-control" name="" id="" cols="30" rows="1"></textarea>
                        </div>
                    </li>
                </ul> -->

                {{ Form::open(array(
                        "url" => "fixrequests/addcomment",
                        "id" => "addcomment-form",
                        "role" => "form")) }} 
                <div class="form-group">
                    {{ Form::textarea("comment", Input::old("insert comment"), array(
                        "placeholder" => "comment...", 
                        "class" => "form-control", 
                        "id" => "comment",
                        "rows" => "3"
                    )) }}
                </div>
                <div class="form-group">
                    {{ Form::hidden("fixrequest-id",$fixrequest['id'], array(
                        "placeholder" => "fixrequest-id", 
                        "class" => "form-control", 
                        "id" => "fixrequest-id"
                    ))}}
                </div>
                <button type="submit" class="btn btn-success">Add Comment</button>
                {{ Form::close() }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Fix Request Stats</h3>
            </div>
            <div class="panel-body">
                This will show the stats of this fix request
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Recommended Fixers</h3>
            </div>
            <div class="panel-body">
                This will show fixers that are able to do this repair
            </div>
        </div>
         <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Related Fix Requests</h3>
            </div>
            <div class="panel-body">
                This will show fix requests similar to this one
            </div>
        </div>
    </div>
</div>

@stop

