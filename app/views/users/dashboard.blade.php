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
        @include('users.userSideBox')   
    </div>
</div>
@stop

