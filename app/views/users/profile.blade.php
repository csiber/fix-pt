@extends('users/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="well well-lg">
            <div class="row">
                <a href="{{ URL::to('users/edit') }}"  class="btn btn-default btn pull-right">
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
                    <?php if (Auth::user()->email) : ?>
                        <p class="p-shadow"><b>Member since:</b>&nbsp;{{Auth::user()->created_at}}</p>                
                    <?php endif; ?>
                    <?php if (Auth::user()->email) : ?>
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
    </div>
    <div class="col-md-4">
        <div class="well well-sm sidebar-steps">
            <ul>
                @if (Auth::user()->user_type == 'Administrator')
                    <li><a href="{{{ URL::to('users/manage_users') }}}" class="_users">Manage Users</a></li>
                @endif
                <li>Links For User Actions TODO</li>                    
            </ul>
        </div>            
    </div>
</div>
    @stop

