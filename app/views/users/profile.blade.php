@extends('users/layout')

@section('content')

<div class="row">
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('users/index')}}">Users</a></li>
            <li class="active">{{{Auth::user()->username}}}</li>
        </ol>
        <div class="well well-lg">
            <div class="row">				
                <a href="{{ URL::to('users/edit/'.Auth::user()->id.'') }}"  class="btn btn-default btn pull-right">
                    <span class="glyphicon glyphicon-pencil"></span> Edit Profile
                </a>         
            </div>
            <div class="row">
               
                <div class="col-md-4">
                    <img src="{{$gravatar}}" alt="..." class="img-thumbnail">
                </div>
                <div class="col-md-8">
                    <h3>{{(Auth::user()->full_name)?Auth::user()->full_name:Auth::user()->username}}</h3>
                    <br/>
                    <?php if (Auth::user()->full_name) : ?>
                        <p class="p-shadow"><b>Username:</b>&nbsp;{{Auth::user()->username}}</p>
                    <?php endif; ?>
                    <?php if (Auth::user()->email) : ?>
                        <p class="p-shadow"><b>Email:</b>&nbsp;{{Auth::user()->email}}</p>                
                    <?php endif; ?>
                    <?php if (Auth::user()->created_at) : ?>
                        <p class="p-shadow"><b>Member since:</b>&nbsp;{{Auth::user()->created_at}}</p>                
                    <?php endif; ?>
                    <?php if (Auth::user()->last_login) : ?>
                        <p class="p-shadow"><b>Last login:</b>&nbsp;{{Auth::user()->last_login}}</p>                
                    <?php endif; ?>
                    <span class="label label-fix-pt">{{Auth::user()->user_type}} Account</span>
                    <?php if (Auth::user()->confirmed == 1) : ?>
                        <span class="label label-fix-pt">Confirmed User</span>    
                    <?php else : ?>
                        <span class="label label-fix-pt">User is not confirmed!</span>
                        <!-- <a href="{{ URL::to('users/confirm-user') }}" class="btn btn-default btn-xs">Confirm User</a> -->

<!--                         <br/><span class="p-shadow"><small>Not confirmed user account is removed within 3 days!</small></span>
 -->                <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="well well-lg">
            <ul class="nav nav-pills">
                <li @if ($sort == "all")class="active"@endif><a href="{{ URL::to('users/profile/all') }}">All</a></li>
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
        @include('users.userSideBox')           
    </div>
</div>
@stop

