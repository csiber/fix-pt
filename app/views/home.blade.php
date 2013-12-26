@extends('layout')
@section('content')
    <div class="jumbotron">
      <div class="container">
        <h1 class="text-center">Can't fix it yourself?</h1>
        <p class="text-center">Make your request and receive offers from the best fixers. Pick only the best.</p>
        <div class="container home-search">
        <div class="row">
            {{ Form::open(array(    
                "url"        => "search/index",
                "method"    => "post",
                "autocomplete" => "off",
                "id"=> "search-form"
            )) }}
                <div class="col-lg-6">   
                    <input name="text" type="text" class="form-control" placeholder="What?">
                </div>
                <div class="col-lg-3">
                    <input type="text" id="district-home-search" class="form-control typeahead" placeholder="where?">
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-danger">Search</button>
                </div>
            {{ Form::close() }}
        </div> 
        </div>
      </div>
    </div>
    <div class="container small-top-padding">
        <h1 class="text-center">How it works</h1>
        <div class="row how-it-works">
            <div class="col-lg-4">
                <h2 class="brand-color">1</h3>
                <h4>Make a request describing the job you need to be done</h4>
            </div>
            <div class="col-lg-4">
                <h2 class="brand-color">2</h2>
                <h4>Receive multiple offers from our fixers</h4>
            </div>
            <div class="col-lg-4">
                <h2 class="brand-color">3</h2>
                <h4>Compare them and pick only the best one</h4>
            </div>
        </div>
    </div>

    <div class="white-bc">
        <div class="container small-top-padding white-bc">
            <h1 class="text-center">Categories</h1>
            <div class="row">
                <div class="col-lg-6">
                    <div class="thumbnail">
                        <img data-src="holder.js/300x200" alt="...">
                        <div class="caption">
                            <h3>Home</h3>
                            <p>...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="thumbnail">
                        <img data-src="holder.js/300x200" alt="...">
                        <div class="caption">
                            <h3>Gardening</h3>
                            <p>...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="thumbnail">
                        <img data-src="holder.js/300x200" alt="...">
                        <div class="caption">
                            <h3>Mechanics</h3>
                            <p>...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thumbnail">
                        <img data-src="holder.js/300x200" alt="...">
                        <div class="caption">
                            <h3>Gardening</h3>
                            <p>...</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thumbnail">
                        <img data-src="holder.js/300x200" alt="...">
                        <div class="caption">
                            <h3>Mechanics</h3>
                            <p>...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop