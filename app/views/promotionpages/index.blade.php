@extends('promotionpages/layout')

@section('content')
<div class="row">
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li class="active">Promotion Pages</li>
        </ol>
        <div class="well well-lg">
            <div class="promotionpages">
                @foreach($promotionpages as $promotionpage)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4><a href="{{ URL::to('promotionpages/show/'.$promotionpage->id) }}">{{{$promotionpage->title}}}</a></h4>
                        <p>{{{$promotionpage->body}}}</p>
                        <div class="tags">
                            <span class="tag pull-right label category-label">{{$promotionpage->category['name']}}</span>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="row text-center">
                            <div class="col-md-4 col-xs-6"><i class="fa fa-user"></i> by <a href="{{ URL::to('users/view/'.$promotionpage->user_id.'')}}">{{{$promotionpage->username}}}</a></div>
                            <div class="col-md-4 col-xs-6"><i class="fa fa-calendar-o"></i> {{$promotionpage->created_at_pretty}}</div>
                            <div class="col-md-4 col-xs-12"><i class="fa fa-location-arrow"></i> {{$promotionpage->city}} - {{$promotionpage->concelho}}</div>
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
                <h3 class="panel-title lead">Favorite Tags</h3>
            </div>
            <div class="panel-body">
                This will show the favorite tags of the user
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
