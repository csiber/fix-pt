@extends('users/layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('users/index')}}">Users</a></li>
            <li class="active">{{{Auth::user()->username}}}</li>
        </ol>
        <div class="well well-lg">
            <ul class="nav nav-pills">
                <li @if ($sort == "fixrequests")class="active"@endif><a href="{{ URL::to('users/dashboard/fixrequests') }}">Fix requests</a></li>
                <li @if ($sort == "favorites")class="active"@endif><a href="{{ URL::to('users/dashboard/favorites') }}">Favorite Users</a></li>
            </ul>
            @if($sort == "favorites")
                @if (count($favorites) === 0)
                    <hr>
                    <p class="lead">This user doesn't have any favorite fixer!</p>
                @else
                    <hr>
                    <div class="favoritesDashboard">
                        @foreach($favorites as $fav)
                        <div class="media favoriteDashboard">
                            <a class="pull-left" href="{{ URL::to('users/view/'.$fav->user->id)}}">
                                <img class="media-object" src="{{$fav['gravatar']}}" alt="{{$fav->user->username}}">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="{{ URL::to('users/view/'.$fav->user->id)}}">{{$fav->user->username}}</a></h4>
                            </div>
                        </div>
                    @endforeach 
                    </div>
                @endif
            @elseif($sort == "fixrequests")
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
            @endif
        </div>
    </div>
</div>
@stop

