@extends('users/layout')

@section('content')

<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('users/index')}}">Users</a></li>
            <li class="active">{{{Auth::user()->username}}}</li>
        </ol>
        <div class="well well-lg">
            <ul class="nav nav-pills">
                <li @if ($sort == "fixrequests")class="active"@endif><a href="{{ URL::to('') }}">Fix requests</a></li>
                <li @if ($sort == "comments")class="active"@endif><a href="{{ URL::to('') }}">Comments</a></li>
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
            @endif
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
@stop

