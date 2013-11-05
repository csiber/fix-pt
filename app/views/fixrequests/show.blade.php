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
        </div>
        <div class="well well-lg">
            <h4>Comments go here!</h4>
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
                <h3 class="panel-title">Related Fix Requests</h3>
            </div>
            <div class="panel-body">
                This will show fix requests similar to this one
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
    </div>
</div>

@stop

