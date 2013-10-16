<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Fix.pt">
        <meta name="author" content="ldsot3g3">
        

        <title>Fix.PT</title>

        <!-- Bootstrap core CSS -->        
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-theme.min.css') }}">
        <!-- Fix.pt CSS -->
        <link rel="stylesheet" href="{{ URL::asset('css/fix-pt.css') }}">

    </head>

    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            
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
                        <li class="active"><a href="{{{ URL::to('/') }}}">Home</a></li>
                        <li><a href="{{{ URL::to('users') }}}">Users</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
           
        </div>

        <div class="container">
            @yield('content')
        </div><!-- /.container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{ URL::asset('js/jquery-1.10.2.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        
        <!-- Placed at the end of the document so the pages load faster -->
    </body>
</html>

