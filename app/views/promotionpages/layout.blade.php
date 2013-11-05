<!DOCTYPE html>
<html lang="en">
    <head>
        @include('metas')
        <title>Fix.PT - Fix Requests</title>
        @include('css')

    </head>

    <body class="_promotionpages">
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

