@extends('promotionpages/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('promotionpages/index/recent')}}">Promotion Pages</a></li>
            <li class="active">{{{$promotionpage->post->user->username}}}</li>
        </ol>
        <div class="well well-lg promotionpage-details" data-promotionpage-id="{{$promotionpage['post']['user_id']}}">
            
            <h4> 
                @if(Auth::check() && Auth::user()->id != $promotionpage->post->user->id)
                    @if($favorite)
                        <span class="glyphicon glyphicon-star favorite-fixer2" onclick="markFixerAsFavorite(this)"></span>
                    @elseif(Auth::check() && $favorite == false) 
                        <span class="glyphicon glyphicon-star favorite-fixer1" onclick="markFixerAsFavorite(this)"></span>
                    @endif
                @endif
                 {{{$promotionpage->title}}}
            </h4>
            
            <p> {{{$promotionpage->post->text}}} </p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body text-center">
                <img src="{{{$gravatar}}}" alt="...">
                <h3><a href="{{ URL::to('users/view/'.$promotionpage->post->user->id)}}">{{{$promotionpage->post->user->username}}}</a></h3>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title lead">Similar promotion pages</h3>
            </div>
            <div class="panel-body">
                This will show similiar promotion pages
            </div>
        </div>
    </div>
</div>
@stop