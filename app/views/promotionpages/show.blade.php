@extends('promotionpages/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('promotionpages/index/recent')}}">Promotion Pages</a></li>
            <li class="active">{{{$promotionpage->title}}}</li>
        </ol>
        <div class="well well-lg promotionpage-details" data-promotionpage-id="{{$promotionpage['post']['user_id']}}">
            
            <h4> 
                @if($favorite)
                    <span class="glyphicon glyphicon-star favorite-fixer2" onclick="markFixerAsFavorite(this)"></span>
                @elseif($favorite == false && Auth::check()) 
                    <span class="glyphicon glyphicon-star favorite-fixer1" onclick="markFixerAsFavorite(this)"></span>
                @endif
                    {{{$promotionpage->title}}}
            </h4>
            
            <p> {{{$promotionpage['post']['text']}}} </p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="well well-sm sidebar-steps">
            <h3 class="text-center">How you can make a good promtion page</h1>
            <ol class="sidebar-ol">
                <li>Use a clear title and a detailed description to describe what you can do</li>
                <li>Chose the right category</li>
                <li>Upload some photos to show other works you've done</li>
            </ol>
        </div>
    </div>
</div>
@stop