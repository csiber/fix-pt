<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Fix.pt">
        <meta name="author" content="ldsot3g3">
        <link rel="shortcut icon" href="../../assets/ico/favicon.png">
        <title>Fix.PT</title>

        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/fix-pt.css') }}">

    </head>

    <body class="_home">
        <div id="wrap"> <!-- this is for the sticky footer -->
            @include('header')            
                @include('alerts')
                @yield('content')
        </div><!-- /.wrap -->

        @include('footer')

        <!-- Bootstrap core JavaScript
        ================================================== -->

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{ URL::asset('js/jquery-1.10.2.min.js') }}"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>    
    </body>
</html>

