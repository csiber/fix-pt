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
                <li @if ($sort == "favorites")class="active"@endif><a href="{{ URL::to('users/profile/dashboard/favorites') }}">Favorite Users</a></li>
                <li @if ($sort == "feedback")class="active"@endif><a href="{{ URL::to('') }}">Feedback given</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
@stop

