@extends('search/layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="#">Fix.pt</a></li>
            <li class="active">Global Search</li>
        </ol>

        <div class="well well-lg">
            <div class="row search">
            {{ Form::open(array(    
            "url"        => "search/index/" . $sort,
            "method"    => "post",
            "autocomplete" => "off",
            "id"=> "search-form"
            )) }}
                <div class="form-group col-lg-5 col-sm-4 col-xs-4">
                    {{ Form::text("text", $text, array("placeholder" => "Search", "class" => "form-control", "id" => "text", "name" => "text")) }}
                </div>
                <div class="form-group col-lg-4 col-sm-4 col-xs-4">
                    <input type="text" name="district" id="district-home-search" class="form-control typeahead" placeholder="where?" value="{{$district}}">
                </div>
                <div class="col-lg-3 col-sm-4 col-xs-4">
                    <button type="submit" class="btn btn-danger">Search</button>
                </div>
            {{ Form::close(); }}
            </div>
        </div>

        <div class="well well-lg">
            <ul class="nav nav-pills">
                <li @if ($sort == "recent")class="active"@endif><a href="{{ URL::to('search/index/recent') }}">Recent</a></li>
                <li @if ($sort == "popular")class="active"@endif><a href="{{ URL::to('search/index/popular') }}">Popular</a></li>
            </ul>
            <div>

            </div>
            <div class="searchresults">
                @if(count($searchresults) === 0)
                <hr>
                <p class="lead">Your search returned no results.</p>
                @else
                <hr>
                <h4 class="lead">Fix requests</h4>
                @foreach($searchresults as $searchresult)
                @if($searchresult->tipo == "fixrequests")
                <div class="panel panel-default searchresult" data-searchresults-id="{{$searchresult->id}}">
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
                            <div class="col-md-3 col-xs-6"><i class="fa fa-location-arrow"></i> {{{$searchresult->city}}} - {{{$searchresult->concelho}}}</div>
                            <div class="col-md-3 col-xs-6"><i class="fa fa-clock-o"></i> not working yet</div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                <h4 class="lead bottom-h4">Promotion pages</h4>
                @foreach($searchresults as $searchresult)
                @if($searchresult->tipo == "promotionpages")
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
                        <div class="row text-center">
                            <div class="col-md-4 col-xs-6"><i class="fa fa-user"></i> by <a href="{{ URL::to('users/view/'.$searchresult->user_id.'')}}">{{{$searchresult->username}}}</a></div>
                            <div class="col-md-4 col-xs-6"><i class="fa fa-calendar-o"></i> {{$searchresult->created_at_pretty}}</div>
                            <div class="col-md-4 col-xs-6"><i class="fa fa-location-arrow"></i> {{{$searchresult->city}}} - {{{$searchresult->concelho}}}</div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                {{$pags->links()}}
                @endif
            </div>
        </div>
    </div>
</div>

@stop
