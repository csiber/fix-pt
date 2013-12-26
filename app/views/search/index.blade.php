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
            <div>
            {{ Form::open(array(    
            "url"        => "search/index/" . $sort,
            "method"    => "post",
            "autocomplete" => "off",
            "id"=> "search-form"
            )) }}
                {{ Form::text("text", $text, array("placeholder" => "Search", "class" => "form-control", "id" => "text", "name" => "text")) }}
                {{ Form::select('concelhos', $concs, $selconcelho, array('class' => 'form-control', 'id' => 'concelhos', 'name' => 'concelhos')) }}
                <button type="submit" class="btn btn-danger">Search</button>
            {{ Form::close(); }}
            </div>
            <div class="searchresults">
                @if(count($searchresults) === 0)
                <p>Your search returned no results.</p>
                @else
                @foreach($searchresults as $searchresult)
                <div class="panel panel-default" data-searchresults-id="{{$searchresult->id}}">
                    <div class="panel-body">
                        <h4 class=""><a href="{{ URL::to($searchresult->tipo.'/show/'.$searchresult->id) }}">{{{$searchresult->title}}}</a></h4>
                        <p>{{{$searchresult->text}}}</p>
                        <div class="tags">
                            <span class="tag pull-right label category-label">{{$searchresult->category}}</span>
                        </div>
                        <!-- <span class="category two"></span> -->
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-md-3 col-xs-6"><i class="fa fa-user"></i> by <a href="{{ URL::to('users/view/'.$searchresult->user_id.'')}}">{{{$searchresult->username}}}</a></div>
                            <div class="col-md-3 col-xs-6"><i class="fa fa-calendar-o"></i> {{$searchresult->created_at_pretty}}</div>
                            <div class="col-md-3 col-xs-6"><i class="fa fa-location-arrow"></i> not working yet</div>
                            <div class="col-md-3 col-xs-6"><i class="fa fa-clock-o"></i> not working yet</div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{$pags->links()}}
                @endif
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
