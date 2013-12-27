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
                <li @if ($sort == "in_progress")class="active"@endif><a href="{{ URL::to('fixrequests/index/in_progress') }}">In progress</a></li>
            </ul>
            <div class="fixrequests" data-sort="{{$sort}}">
                @if(count($fixrequests) === 0)
                <hr>
                <p class="lead">We don't have fix requests that fit that description</p>
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
                                <div class="col-md-3 col-xs-6"><i class="fa fa-user"></i> by <a href="{{ URL::to('users/view/'.$fixrequest->user_id.'')}}">{{{$fixrequest->username}}}</a></div>
                                <div class="col-md-3 col-xs-6" title="{{$fixrequest->created_at}}"><i class="fa fa-calendar-o"></i> posted {{$fixrequest->created_at_pretty}}</div>
                                <div class="col-md-3 col-xs-6"><i class="fa fa-location-arrow"></i> {{{$fixrequest->concelho}}}, {{{$fixrequest->city}}}</div>
                                @if($sort == 'in_progress')
                                <div class="col-md-3 col-xs-6"><i class="fa fa-clock-o"></i> in progress</div>
                                @else
                                <div class="col-md-3 col-xs-6" title="{{$fixrequest->end_date_exact}}"><i class="fa fa-clock-o"></i> {{$fixrequest->end_date}}</div>
                                @endif
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Filter by category</h3>
            </div>
            <div class="panel-body" id="fixrequest-index-radios">
                <div class="radio">
                    <label>
                        <input type="radio" name="categoryRadios" id="categoryRadios1" value="1" @if($filter && $filter == "1")checked@endif>
                        Home
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="categoryRadios" id="categoryRadios2" value="2" @if($filter && $filter == "2")checked@endif>
                        Gardening
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="categoryRadios" id="categoryRadios3" value="3" @if($filter && $filter == "3")checked@endif>
                        Mechanics
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="categoryRadios" id="categoryRadios4" value="4" @if($filter && $filter == "4")checked@endif>
                        Electronics
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="categoryRadios" id="categoryRadios5" value="5" @if($filter && $filter == "5")checked@endif>
                        Appliances
                    </label>
                </div>
            </div>
        </div>
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
