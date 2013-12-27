@extends('promotionpages/layout')

@section('content')
<div class="row">
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li class="active">Promotion Pages</li>
        </ol>
        <div class="well well-lg">
            <div class="row search">
            {{ Form::open(array(    
            "url"        => "promotionpages/index/" . $sort,
            "method"    => "post",
            "autocomplete" => "off",
            "id"=> "search-form"
            )) }}
                <div class="form-group col-lg-5">
                    {{ Form::text("text", $text, array("placeholder" => "Search", "class" => "form-control", "id" => "text", "name" => "text")) }}
                </div>
                <div class="form-group col-lg-4">
                    <input type="text" name="district" id="district-home-search" class="form-control typeahead" placeholder="where?" value="{{$district}}">
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-danger">Search</button>
                </div>
            {{ Form::close(); }}
            </div>
        </div>
        <div class="well well-lg">
            <div class="promotionpages" data-sort="{{$sort}}">
                @if(count($promotionpages) === 0)
                <hr>
                <p class="lead">We don't have promotion pages that fit that description</p>
                @else
                    @foreach($promotionpages as $promotionpage)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4><a href="{{ URL::to('promotionpages/show/'.$promotionpage->id) }}">{{{$promotionpage->title}}}</a></h4>
                            <p>{{{$promotionpage->post->text}}}</p>
                            <div class="tags">
                                <span class="tag pull-right label category-label">{{$promotionpage->category['name']}}</span>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row text-center">
                                <div class="col-md-4 col-xs-6"><i class="fa fa-user"></i> <a href="{{ URL::to('users/view/'.$promotionpage->user_id.'')}}">{{{$promotionpage->username}}}</a></div>
                                <div class="col-md-4 col-xs-6"><i class="fa fa-calendar-o"></i> {{$promotionpage->created_at_pretty}}</div>
                                <div class="col-md-4 col-xs-12"><i class="fa fa-location-arrow"></i> {{$promotionpage->city}} - {{$promotionpage->concelho}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$promotionpages->links()}}
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Filter by category</h3>
            </div>
            <div class="panel-body" id="promotionpage-index-radios">
                <div class="radio">
                    <label>
                        <input type="radio" name="categoryRadios" id="categoryRadios1" value="1" @if($filter && $filter == "1")checked@endif>
                        Home
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="categoryRadios" id="categoryRadios2" value="2" @if($filter && $filter == "2")checked@endif>
                        Gardening
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="categoryRadios" id="categoryRadios3" value="3" @if($filter && $filter == "3")checked@endif>
                        Mechanics
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="categoryRadios" id="categoryRadios4" value="4" @if($filter && $filter == "4")checked@endif>
                        Electronics
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="categoryRadios" id="categoryRadios5" value="5" @if($filter && $filter == "5")checked@endif>
                        Appliances
                    </label>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title lead">Popular Fixers</h3>
            </div>
            <div class="panel-body">
                Show 3 or less fixers that have the most jobs
            </div>
        </div>
    </div>
</div>

@stop
