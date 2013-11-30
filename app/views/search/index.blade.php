@extends('search/layout')

@section('content')
<div class="row">
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li><a href="#">Fix.pt</a></li>
            <li class="active">Global Search</li>
        </ol>
        <div class="well well-lg">
            <ul class="nav nav-pills">
                <li @if ($sort == "recent")class="active"@endif><a href="{{ URL::to('search/index/recent') }}">Recent</a></li>
                <li @if ($sort == "popular")class="active"@endif><a href="{{ URL::to('search/index/popular') }}">Popular</a></li>
            </ul>
            <div class="search">
                @foreach($searchresults as $searchresult)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4>{{{$searchresult->title}}}</h4>
                        <p>{{{$searchresult->text}}}</p>
                        <div class="tags">
                            <span class="tag pull-right label category-label">{{$searchresult->category}}</span>
                        </div>
                        <!-- <span class="category two"></span> -->
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-3 col-xs-6"><i class="fa fa-user"></i> {{{$searchresult->username}}}</div>
                            <div class="col-md-3 col-xs-6"><i class="fa fa-calendar-o"></i> {{$searchresult->created_at_pretty}}</div>
                            <div class="col-md-3 col-xs-6"><i class="fa fa-location-arrow"></i> not working yet</div>
                            <div class="col-md-3 col-xs-6"><i class="fa fa-clock-o"></i> not working yet</div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{$pags->links()}}
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
