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
            <div class="row">				
                <a href="{{ URL::to('users/edit/'.Auth::user()->id.'') }}"  class="btn btn-default btn pull-right">
                    <span class="glyphicon glyphicon-pencil"></span> Edit Profile
                </a>         
            </div>
            <div class="row">
                <?php
                $spansmall = 0;
                $spanbig = 12;
                if (Auth::user()->user_image) {
                    $spansmall = 3;
                    $spanbig = 8;
                }
                ?>

                <div class="col-md-<?php echo $spansmall ?>">
                    <?php if (Auth::user()->user_image) : ?>
                        <img src="{{ URL::to('img/profile/Auth::user()->user_image') }}" alt="Profile Image" 
                             class="img-thumbnail">
                         <?php endif; ?>
                </div>
                <div class="col-md-<?php echo $spanbig ?>">
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
                        <a href="{{ URL::to('users/confirm-user') }}" class="btn btn-default btn-xs">Confirm User</a>

                        <br/><span class="p-shadow"><small>Not confirmed user account is removed within 3 days!</small></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="well well-lg">
            <ul class="nav nav-pills">
                <li @if ($sort == "favorites")class="active"@endif><a href="{{ URL::to('users/profile/favorites') }}">Favorite Users</a></li>
                <li @if ($sort == "ratings")class="active"@endif><a href="{{ URL::to('users/profile/ratings') }}">Ratings</a></li>
            </ul>
            @if ($sort == "ratings")
                <ul class="nav nav-pills">
                    <li @if ($rsort == "all")class="active"@endif><a href="{{ URL::to('users/profile/ratings/all') }}">All</a></li>
                    <li @if ($rsort == "positive")class="active"@endif><a href="{{ URL::to('users/profile/ratings/positive') }}">Positive</a></li>
                    <li @if ($rsort == "neutral")class="active"@endif><a href="{{ URL::to('users/profile/ratings/neutral') }}">Neutral</a></li>
                    <li @if ($rsort == "negative")class="active"@endif><a href="{{ URL::to('users/profile/ratings/negative') }}">Negative</a></li>
                </ul>
                @if(count($search) === 0)
                <div>No ratings available.</div>
                @else
                	<div>Role</div><div>Rating</div>
                    @foreach($search as $sch)
                    <a href="{{ URL::to('fixrequests/show/'.$sch->fix_request_id) }}"><div>@if ($sch->user_id == $sch->fixer_id) Fixer @else Requester @endif</div><div>{{{$sch->score}}}</div></a>
                    @endforeach
                @endif
            @endif
        </div>
    </div>
    <div class="col-md-4">
        @include('users.userSideBox')           
    </div>
</div>
@stop

