<?php
/*
 * File: userSideBox.blade.php
 * Left side bar to apper on user profile
 */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title lead">Ratings</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li class="active"><a href="{{ URL::to('users/ratings') }}">All</a></li>
            <li class="active"><a href="{{ URL::to('users/ratings/positive') }}">Positive</a></li>
            <li class="active"><a href="{{ URL::to('users/ratings/neutral') }}">Neutral</a></li>
            <li class="active"><a href="{{ URL::to('users/ratings/negative') }}">Negative</a></li>
        </ul>
        <br/>
        <div class="panel panel-default">
            <div class="panel-body">
                <h5 class="">Last Ratings</h5>
                <ul>
                    <li>last user rating 1</li>
                    <li>last user rating 2</li>
                    <li>last user rating 3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title lead">Tips</h3>
    </div>
    <div class="panel-group tips" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <span class="glyphicon glyphicon-info-sign"></span>&nbsp;
                        How to get a good ratings?
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <span class="glyphicon glyphicon-info-sign"></span>&nbsp;
                        How you can rate other's peoples works?
                    </a>                    
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">                    
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        <span class="glyphicon glyphicon-info-sign"></span>&nbsp;
                        Where can I see my ratings?
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
            </div>
        </div>
    </div>
</div>

@if (Auth::check())
    @include('actions')    
@endif