<?php
/*
 * File: actions.blade.php
 * Left side bar to apper on user profile
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title lead">Actions</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills">
            @if (Auth::user()->user_type == 'Administrator')
            <li class="active"><a href="{{{ URL::to('users/index') }}}" class="_users">Manage Users</a></li>
            @endif
            @if (Auth::user()->user_type == 'Premium')
            <li class="active"><a href="{{ URL::to('users/downgrade') }}"  class="_users">Downgrade Account</a></li>
            @endif
            @if (Auth::user()->user_type == 'Standard')
            <li class="active"><a href="{{ URL::to('users/upgrade') }}"  class="_users">Upgrade Account</a></li>
            @endif
            @if (Auth::user()->user_type == 'Moderator')
            <li class="active"><a href="{{ URL::to('users/downgrade') }}"  class="_users">Revoke Moderator Rights</a></li>
            @endif
            <li class="active"><a href="{{ URL::to('users/dashboard') }}"  class="_users">Dashboard</a></li>                    
        </ul>
    </div>
</div>







