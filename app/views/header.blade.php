<header>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{{ URL::to('/') }}}">Fix.PT</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <li><a href="{{{ URL::to('/') }}}" class="_home">Home</a></li>
                    <li><a href="{{{ URL::to('users') }}}" class="_users">Users</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" class="_fixrequests">Fix Requests <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">View Fix Requests</a></li>
                            <li><a href="#">Search Fix Requests</a></li>
                            <li><a href="{{ URL::to('fixrequests/create') }}">Add Fix Request</a></li>
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
                <ul class="nav navbar-nav navbar-right">                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged in as <b>{{{ (Auth::user()->full_name)?Auth::user()->full_name:Auth::user()->username  }}} </b><b class="caret"></b></a>
                        <ul class="dropdown-menu">   
                            <li><a href="{{{ URL::to('users/dashboard') }}}">Fix.pt Dashboard</a></li>
                            <li><a href="{{{ URL::to('users/profile') }}}">User Profile</a></li>
                            <li><a href="{{{ URL::to('users/reset-password/') }}}">Change Password</a></li>
                            <li><a href="{{{ URL::to('users/logout') }}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>                
                @else                
                {{ Form::open(array(
                "autocomplete" => "off",
                "url" => "users/login",  
                "id"=>"login-form",
                "class" => "navbar-form navbar-right"))}}
                <form class="navbar-form navbar-right" action="users/login">
                    <div class="form-group">
                        {{ Form::text("username", Input::old("username"), 
                        ["placeholder" => "Username", "class"=>"form-control"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::password("password", ["placeholder" => "Password",
                        "class"=>"form-control"]) }}
                    </div>
                    <button type="submit" form="login-form" class="btn btn-success">Sign In</button>
                    <button data-toggle="modal" href="#signUpModal" class="btn btn-primary">Sign Up</button>
                    {{ Form::close() }}
                    @endif
            </div><!--/.nav-collapse -->  
        </div>      
    </div>
</header>

<!-- Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Sign Up</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array("url" => "users/create",
                "autocomplete" => "off",
                "id"=>"signup-form","role"=>"form"))}}                
                <div class="form-group">
                    {{ Form::label("username", "Name") }}
                    {{ Form::text("username", Input::old("username"), 
                    ["placeholder" => "Enter Username", "class"=>"form-control", "id"=>"username"]) }}                        
                </div>
                <div class="form-group">
                    {{ Form::label("email", "Email") }}
                    {{ Form::text("email", Input::old("email"), 
                    array("placeholder" => "Enter email", "class"=>"form-control", "id"=>"email")) }}                        
                </div>
                <div class="form-group"> 
                    {{ Form::label("password", "Password") }}
                    {{ Form::password('password', array("class"=>"form-control", "placeholder"=>"Password"))}}

                </div>
                <div class="form-group">                        
                    {{ Form::label("confirm_password", "Confirm Password") }}
                    {{ Form::password('confirm_password', array("class"=>"form-control", "placeholder"=>"Confirm Password"))}}

                </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="signup-form" class="btn btn-success">Sign Up</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->