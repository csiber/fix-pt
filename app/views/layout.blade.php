<!DOCTYPE html>
<html lang="en">
    <head>
        @include('metas')
        <link rel="shortcut icon" href="../../assets/ico/favicon.png">
        <title>Fix.PT</title>
        @include('css')
    </head>
    <body class="_home">
        <div id="wrap"> <!-- this is for the sticky footer -->
            @include('header')            
            @include('alerts')
            @yield('content')
        </div><!-- /.wrap -->
        @include('footer')
        @include('js')
    </body>
</html>q
