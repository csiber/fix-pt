@extends('fixrequests/layout')

@section('content')
<div class="row">
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li class="active">Fix Requests</li>
        </ol>
        <div class="well well-lg">
            <ul class="nav nav-pills">
                <li @if ($sort == "recent")class="active"@endif><a href="{{ URL::to('fixrequests/index/recent') }}">Recent</a></li>
                <li @if ($sort == "popular")class="active"@endif><a href="{{ URL::to('fixrequests/index/popular') }}">Popular</a></li>
                <li @if ($sort == "ending_soon")class="active"@endif><a href="{{ URL::to('fixrequests/index/ending_soon') }}">Ending soon</a></li>
                <li @if ($sort == "no_offers")class="active"@endif><a href="{{ URL::to('fixrequests/index/no_offers') }}">No offers</a></li>
            </ul>
            <div class="fixrequests">
                @if(count($fixrequests) === 0)
                    <p>We have no fix requests to show you</p>
                @else
                    @foreach($fixrequests as $fixrequest)
                    <div class="panel panel-default" data-fixrequest-id="{{$fixrequest->id}}">
                        <div class="panel-body">
                            <h4 class=""><a href="{{ URL::to('fixrequests/show/'.$fixrequest->id) }}">{{{$fixrequest->title}}}</a></h4>
                            <p>{{{$fixrequest->text}}}</p>
                            <div class="tags">
                                @foreach($fixrequest['tags'] as $tag)
                                <span class="tag label brand-bc">{{{$tag['name']}}}</span>
                                @endforeach
                                <span class="tag pull-right label category-label">{{$fixrequest->category['name']}}</span>
                            </div>
                            <!-- <span class="category two"></span> -->
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-md-3 col-xs-6"><i class="fa fa-user"></i> by {{{$fixrequest->username}}}</div>
                                <div class="col-md-3 col-xs-6" title="{{$fixrequest->created_at}}"><i class="fa fa-calendar-o"></i> created {{$fixrequest->created_at_pretty}}</div>
                                <div class="col-md-3 col-xs-6"><i class="fa fa-location-arrow"></i> not working yet</div>
                                <div class="col-md-3 col-xs-6" title="{{$fixrequest->end_date_exact}}"><i class="fa fa-clock-o"></i> {{$fixrequest->end_date}}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{$fixrequests->links()}}
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <!-- <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Favorite Tags</h3>
            </div>
            <div class="panel-body">
                This will show the favorite tags of the user
            </div>
        </div> -->
        <div class="panel panel-default popular-tags">
            <div class="panel-heading">
                <h3 class="panel-title lead">Popular Tags</h3>
            </div>
            <div class="panel-body">
                @foreach($popular_tags as $tag)
                <div>
                    <span class="tag label brand-bc">{{{$tag->name}}} &times; {{{$tag->used}}}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@stop
