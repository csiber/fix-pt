@extends('promotionpages/layout')

@section('content')
<div class="row">
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li><a href="#">Fix.pt</a></li>
            <li class="active">Promotion Pages</li>
        </ol>
        <div class="well well-lg">
            <div class="fixrequests">
                @foreach($promotionpages as $promotionpage)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>{{{$promotionpage->title}}}</h4>
                        <p>{{{$promotionpage->body}}}</p>
                        <!-- <span class="category {{$fixrequest->category_class}}"></span> -->
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-3 col-xs-6"><i class="fa fa-user"></i> {{{$promotionpage->username}}}</div>
                            <div class="col-md-3 col-xs-6"><i class="fa fa-calendar-o"></i> {{$promotionpage->created_at_pretty}}</div>
                            <div class="col-md-3 col-xs-6"><i class="fa fa-location-arrow"></i> not working yet</div>
                            <div class="col-md-3 col-xs-6"><i class="fa fa-clock-o"></i> not working yet</div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{$promotionpages->links()}}
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Favorite Tags</h3>
            </div>
            <div class="panel-body">
                This will show the favorite tags of the user
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Popular Tags</h3>
            </div>
            <div class="panel-body">
                This will show the most used tags
            </div>
        </div>
    </div>
</div>

@stop
