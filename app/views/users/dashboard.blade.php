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
            
            <div c  lass="panel panel-default">
                <div class="panel-body"><h3>My Fix Requests</h3></div>
                
               
            </div>
            <div class="panel panel-default">
                <div class="panel-body"><h3>My Promotion Page</h3></div>
            </div>
            
            
            
        </div>
    </div>
    <div class="col-md-4">
        <div class="well well-sm sidebar-steps"> 
            <h3 class="text-center">User Ratings</h3>
            <ul class="nav nav-pills">
                <li class="active"><a href="{{ URL::to('users/ratings') }}">All</a></li>
                <li class="active"><a href="{{ URL::to('users/ratings/positive') }}">Positive</a></li>
                <li class="active"><a href="{{ URL::to('users/ratings/neutral') }}">Neutral</a></li>
                <li class="active"><a href="{{ URL::to('users/ratings/negative') }}">Negative</a></li>
            </ul>
        </div>
        <div class="well well-sm sidebar-steps">
            <ul>
                @if (Auth::user()->user_type == 'Administrator')
                    <li><a href="{{{ URL::to('users/index') }}}" class="_users">Manage Users</a></li>
                @endif
                @if (Auth::user()->user_type == 'Premium')
                    <li><a href="{{ URL::to('users/downgrade/'.Auth::user()->id.'') }}"  class="_users">Downgrade Account</a></li>
                @endif
                @if (Auth::user()->user_type == 'Standard')
                    <li><a href="{{ URL::to('users/upgrade/'.Auth::user()->id.'') }}"  class="_users">Upgrade Account</a></li>
                @endif
                <li>Links For User Actions TODO</li>                    
            </ul>
        </div>
    </div>
</div>
@stop

