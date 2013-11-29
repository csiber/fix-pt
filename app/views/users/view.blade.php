@extends('users/layout')

@section('content')

<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('users/index')}}">Users</a></li>
            <li class="active">{{$user->username}}</li>
        </ol>
        <div class="well well-lg">
            <div class="row">
                <?php
                $spansmall = 0;
                $spanbig = 12;
                if ($user->user_image) {
                    $spansmall = 3;
                    $spanbig = 8;
                }
                ?>

                <div class="col-md-<?php echo $spansmall ?>">
                    <?php if ($user->user_image) : ?>
                        <img src="{{ URL::to('img/profile/$user->user_image') }}" alt="Profile Image" 
                             class="img-thumbnail">
                         <?php endif; ?>
                </div>
                <div class="col-md-<?php echo $spanbig ?>">
                    <h3>{{($user->full_name)?$user->full_name:$user->username}}</h3>
                    <br/>
                    <?php if ($user->full_name) : ?>
                        <p class="p-shadow"><b>Username:</b>&nbsp;{{$user->username}}</p>
                    <?php endif; ?>
                    <?php if ($user->email) : ?>
                        <p class="p-shadow"><b>Email:</b>&nbsp;{{$user->email}}</p>                
                    <?php endif; ?>                    
                    <?php if ($user->last_login) : ?>
                        <p class="p-shadow"><b>Last login:</b>&nbsp;{{$user->last_login}}</p>                
                    <?php endif; ?>
                    <span class="label label-fix-pt">{{$user->user_type}} Account</span>
                    <?php if ($user->confirmed == 1) : ?>
                        <span class="label label-fix-pt">Confirmed User</span>    
                    <?php else : ?>
                        <span class="label label-fix-pt">User is not confirmed!</span>                        
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="well well-sm sidebar-steps">
            <h3 class="text-center">User Ratings</h1>
            <ol class="sidebar-ol">
                <li>Positive</li>
                <li>Neutral</li>
                <li>Negative</li>
            </ol>
        </div>        
    </div>
</div>



    @stop

