@extends('layout')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">User Profile</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">User Type</div>
            <div class="col-md-8">{{Auth::user()->user_type}}</div>
        </div>
        <div class="row">
            <div class="col-md-4">Username</div>
            <div class="col-md-8">{{Auth::user()->username}}</div>
        </div>
        <div class="row">
            <div class="col-md-4">Full Name</div>
            <div class="col-md-8">{{Auth::user()->full_name}}</div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-8"><small><b>Last login:</b>{{Auth::user()->last_login}}&nbsp:&nbsp;{{(Auth::user()->confirmed==1)?"Active":"Inactive"}}</small></div>
        </div>
    </div>
</div>


<pre>
    <? var_dump(Auth::user()); ?>

</pre>

@stop

