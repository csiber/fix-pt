<!DOCTYPE html>
<html lang="en">
    <head>
        @include('metas')
        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
        <title>Fix.PT - Users</title>
        @include('css')

    </head>

    <body class="_users">
        <div id="wrap"> <!-- this is for the sticky footer -->
            @include('header')            
            <div class="container">
                @include('alerts')
                @yield('content')
            </div>          
        </div><!-- /.wrap -->

        
        @include('footer')
        @include('js')     
    </body>
</html>

