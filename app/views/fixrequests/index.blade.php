@extends('fixrequests/layout')

@section('content')
<div class="row">
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li><a href="#">Fix.pt</a></li>
            <li class="active">Fix Requests</li>
        </ol>
        <div class="well well-lg">
            <ul class="nav nav-pills">
                <li class="active"><a href="#">Recent</a></li>
                <li><a href="#">Popular</a></li>
                <li><a href="#">No offers</a></li>
            </ul>
            <div class="fixrequests">
                @foreach($fixrequests as $fixrequest)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>{{$fixrequest->title}}</h4>
                        <p>{{$fixrequest->text}}</p>
                        <div class="tags">
                            <span class="tag label brand-bc">smartphone</span>
                            <span class="tag label brand-bc">lcd</span>
                            <span class="tag label brand-bc">display</span>
                        </div>
                        <span class="category one"></span>
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-3"><i class="fa fa-user"></i> {{$fixrequest->username}}</div>
                            <div class="col-md-3"><i class="fa fa-calendar-o"></i> {{$fixrequest->created_at_pretty}}</div>
                            <div class="col-md-3"><i class="fa fa-location-arrow"></i> not working yet</div>
                            <div class="col-md-3"><i class="fa fa-clock-o"></i> not working yet</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Favorite Tags</h3>
            </div>
            <div class="panel-body">
                This will show the favorite tags of the user
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Popular Tags</h3>
            </div>
            <div class="panel-body">
                This will show the most used tags
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Recent Tags</h3>
            </div>
            <div class="panel-body">
                This will show the most recent used tags
            </div>
        </div>
    </div>
</div>

@stop
