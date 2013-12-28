@extends('users/layout')

@section('content')

<div class="row">
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('users/index')}}">Users</a></li>
            <li class="active">{{{$user->username}}}</li>
        </ol>
        <div class="well well-lg">
            @if(Auth::check() && Auth::user()->id == $user->id)
            <div class="row">               
                <a href="{{ URL::to('users/edit/'.Auth::user()->id.'') }}"  class="btn btn-default btn pull-right">
                    <span class="glyphicon glyphicon-pencil"></span> Edit Profile
                </a>         
            </div>
            @endif
            <div class="row">
               
                <div class="col-md-4">
                    <img src="{{$gravatar}}" alt="..." class="img-thumbnail">
                </div>
                <div class="col-md-8">
                    <h3>{{($user->fullname)?$user->fullname:$user->username}}</h3>
                    <br/>
                    <p class="p-shadow"><b>Username: </b>{{$user->username}}</p>
                    <p class="p-shadow"><b>Email: </b>{{$user->email}}</p>
                    <p class="p-shadow"><b>Member since: </b>{{$user->created_at}}</p>
                    <p class="p-shadow"><b>Last login: </b>{{$user->last_login}}</p>
                    <span class="label label-fix-pt">{{$user->user_type}} Account</span>
                    @if($user->confirmed)
                        <span class="label label-fix-pt">Confirmed user</span>
                    @else
                        <span class="label label-fix-pt">User is not confirmed</span>
                        <a href="{{ URL::to('users/confirm-user') }}" class="btn btn-default btn-xs">Confirm user</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="well well-lg">
            <ul class="nav nav-pills">
                <li @if ($sort == "all")class="active"@endif><a href="{{ URL::to('users/view/all') }}">All</a></li>
                <li @if ($sort == "positive")class="active"@endif><a href="{{ URL::to('users/profile/positive') }}">Positive</a></li>
                <li @if ($sort == "neutral")class="active"@endif><a href="{{ URL::to('users/profile/neutral') }}">Neutral</a></li>
                <li @if ($sort == "negative")class="active"@endif><a href="{{ URL::to('users/profile/negative') }}">Negative</a></li>
            </ul>
            <hr>
            @if(count($ratings) === 0)
            <p class="lead">No ratings available.</p>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Feedback</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ratings as $rate)
                            <tr>
                                <td>
                                    @if($rate->user_id == $rate->requester_id )
                                    <a href="{{ URL::to('users/view/'.$rate->requester->id)}}"><img src="{{$rate->requester->gravatar}}"> {{$rate->requester->username}}</a>
                                    @else
                                    <a href="{{ URL::to('users/view/'.$rate->fixer->id)}}"><img src="{{$rate->fixer->gravatar}}"> {{$rate->fixer->username}}</a>
                                    @endif
                                </td>
                                <td>
                                    @if($rate->user_id == $rate->requester_id )
                                    <a href="{{ URL::to('users/view/'.$rate->fixer->id)}}"><img src="{{$rate->fixer->gravatar}}"> {{$rate->fixer->username}}</a>
                                    @else
                                    <a href="{{ URL::to('users/view/'.$rate->requester->id)}}"><img src="{{$rate->requester->gravatar}}"> {{$rate->requester->username}}</a>
                                    @endif
                                </td>
                                <td>{{{$rate->feedback}}}</td>
                                <td>{{{$rate->score}}} <i class='glyphicon glyphicon-star'></i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title lead">Latest ratings as fixer</h3>
    </div>
    <div class="panel-body">
        @if($lastrates && count($lastrates) === 0)
        <p>No ratings available.</p>
        @elseif($lastrates)
        @foreach($lastrates as $lr)
        <div class="media favoriteDashboard">
            <a class="pull-left" href="{{ URL::to('users/view/'.$lr->requester->id)}}">
                <img class="media-object" src="{{$lr->requester->gravatar}}" alt="{{$lr->requester->username}}">
            </a>
            <div class="media-body">
                <h5 class="media-heading"><a href="{{ URL::to('users/view/'.$lr->requester->id)}}">{{$lr->requester->username}}</a> gave {{$rate->score}} <i class='glyphicon glyphicon-star'></i></h5>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>           
</div>
</div>
@stop

