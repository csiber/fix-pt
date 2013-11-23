@extends('promotionpages/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('promotionpages/index/recent')}}">Promotion Pages</a></li>
            <li class="active">{{{$promotionpage->title}}}</li>
        </ol>
        <div class="well well-lg">
            <h4> 
                <span class="glyphicon glyphicon-star-empty favorite-fixer" onclick="markFixerAsFavorite(this)"></span>
                {{{$promotionpage->title}}} 
            </h4>
            <p> {{{$promotionpage['post']['text']}}} </p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="well well-sm sidebar-steps">
            <h3 class="text-center">How you can make a good request</h1>
            <ol class="sidebar-ol">
                <li>Use a clear title and a detailed description to describe your request</li>
                <li>Chose the right category and add meaningful tags</li>
                <li>Upload some photos to show what needs to be repaired</li>
            </ol>
        </div>
    </div>
</div>
@stop