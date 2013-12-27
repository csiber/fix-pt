<!DOCTYPE html>
<html lang="en">
    <head>
        @include('metas')
        <link rel="shortcut icon" href="../../assets/ico/favicon.png">
        <title>Fix.PT - Page not found!</title>
        @include('css')

    </head>

    <body>
        <div id="wrap"> <!-- this is for the sticky footer -->
            @include('header')            
            <div class="container">
                @include('alerts')
                <div class="text-center page_404">
                    <h1>404</h1>
                </div>
                <h4 class="text-center">Ooops. Sorry, we didn't found the page you were looking for.</h4>
            </div>          
        </div><!-- /.wrap -->

        @include('footer')
        @include('js')
    </body>
</html>


