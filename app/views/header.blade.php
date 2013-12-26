<header>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{{ URL::to('/') }}}">FIX.pt</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <li><a href="{{{ URL::to('/') }}}" class="_home">Home</a></li>
                    @if (Auth::check() && Auth::user()->user_type == 'Administrator')
                    <li><a href="{{{ URL::to('users/index') }}}" class="_users">Users</a></li>
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle _fixrequests" data-toggle="dropdown">Fix Requests <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ URL::to('fixrequests/index/recent') }}">View Fix Requests</a></li>
                            <li><a href="{{ URL::to('fixrequests/search/recent') }}">Search Fix Requests</a></li>
                            @if (Auth::check())
                            <li><a href="{{ URL::to('fixrequests/create') }}">Add Fix Request</a></li>
                            @endif
                            <!--
                            <li class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                            -->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle _promotionpages" data-toggle="dropdown">Promotion Pages <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ URL::to('promotionpages/index/recent') }}">View Promotion Pages</a></li>
                            <li><a href="#">Search Promotion Pages</a></li>
                            @if (Auth::check())
                            <li><a href="{{ URL::to('promotionpages/create') }}">Create Promotion Page</a></li>
                            @endif
                            <!--
                            <li class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                            -->
                        </ul>
                    </li>               
                </ul>


                @if (Auth::check())

                <?php $notifications=Notification::getNotificationsOfUser(Auth::user()->id); ?>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Notifications <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php $havenew=false; ?>
                            @if(isset($notifications) && count($notifications)>0)
                            @foreach($notifications as $notif)
                                @if($notif['comments']>0)
                                    <li><a href="#" >{{$notif['comments']}} new comments on request: {{$notif['title']}}</a></li>
                                    <?php $havenew=true; ?>
                                @endif
                                @if($notif['offers']>0)
                                    <li><a href="#" >{{$notif['offers']}} new offers on request: {{$notif['title']}}</a></li>
                                    <?php $havenew=true; ?>
                                @endif
                                
                            @endforeach   
                            @endif
                            @if(!$havenew)
                                <li><a href="#" >Sem novas entradas</a></li>
                            @endif
                        </ul>
                    </li>                  
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{{ (Auth::user()->full_name)?Auth::user()->full_name:Auth::user()->username  }}} <b class="caret"></b></a>
                        <ul class="dropdown-menu">   
                            <li><a href="{{{ URL::to('users/dashboard') }}}">Fix.pt Dashboard</a></li>
                            <li><a href="{{{ URL::to('users/profile') }}}">User Profile</a></li>
                            <li><a href="{{{ URL::to('users/reset-password/') }}}">Change Password</a></li>
                            <li><a href="{{{ URL::to('users/logout') }}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>                
                @else                
                <form class="navbar-form navbar-right" action="users/login">
                    <button data-toggle="modal" href="#signInModal" class="btn btn-sm" id="buttonLogin">Login</button>
                    <button data-toggle="modal" href="#signUpModal" class="btn btn-sm">Sign Up</button>
                </form>
                @endif

            </div><!--/.nav-collapse -->  
        </div>      
    </div>
</header>

@if (!Auth::check())
    @include('signInModal')
    @include('signUpModal')
@endif

@include('resetPassModal')