@extends('fixrequests/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('fixrequests/index/recent')}}">Fix Requests</a></li>
            <li class="active">{{{$fixrequest->title}}}</li>
        </ol>
        <div class="well well-lg">
            <h4>{{{$fixrequest->title}}}</h4>
            <p>{{{$fixrequest['post']->text}}}</p>
        </div>
        <div class="well well-lg">
            <h4>Fix Offers</h4>
        </div>
        <div class="well well-lg">
            <h4>Comments</h4>
            @foreach($fixrequest['comments'] as $comment)
                <p></p>
            @endforeach
            {{ Form::open(array(
                    "url" => "fixrequests/addcomment",
                    "id" => "addcomment-form",
                    "role" => "form")) }} 
            {{ Form::text("comment", Input::old("insert comment"), 
                    array("placeholder" => "comment", "class" => "form-control")) }}
            
            <div class="form-group">
                <button type="submit" class="btn btn-success">Add Comment</button>
            </div>
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

