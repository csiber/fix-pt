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
                <div class="col-lg-3">   
                    <input name="text" type="text" class="form-control" placeholder="Text input">
                </div>
                <div class="col-lg-6">
                    <input type="text" id="district-input" class="form-control typeahead" placeholder="District">
                    <?php
                        echo Form::select('id', $dists, "", array('class' => 'form-control', 'id' => 'distritoshome', 'name' => 'distritoshome'));  
                    ?>
                    <select class="form-control" id="concelhos" name="concelhos">
                      <option value="">Escolha um concelho </option>
                    </select>
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
                <h2 class="brand-color">1. Ask</h2>
                <p>Zombies reversus ab inferno, nam malum cerebro. De carne animata corpora quaeritis. Summus sit​​, morbo vel maleficia? De Apocalypsi undead dictum mauris.</p>
            </div>
            <div class="col-lg-4">
                <h2 class="brand-color">2. Pick</h2>
                <p>Zombies reversus ab inferno, nam malum cerebro. De carne animata corpora quaeritis. Summus sit​​, morbo vel maleficia? De Apocalypsi undead dictum mauris.</p>
            </div>
            <div class="col-lg-4">
                <h2 class="brand-color">3. Get it</h2>
                <p>Zombies reversus ab inferno, nam malum cerebro. De carne animata corpora quaeritis. Summus sit​​, morbo vel maleficia? De Apocalypsi undead dictum mauris.</p>
            </div>
        </div>
    </div>

    <div class="white-bc">
        <div class="container small-top-padding white-bc">
            <h1 class="text-center">Popular</h1>
            <div class="row">
                <div class="col-lg-3">
                    <img src="http://placehold.it/140x140" alt="...">
                    <div class="caption">
                        <h3>Title</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-default">Button</a></p>
                    </div>
                </div>
                <div class="col-lg-3">
                     <img src="http://placehold.it/140x140" alt="...">
                    <div class="caption">
                        <h3>Title</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-default">Button</a></p>
                    </div>
                </div>
                <div class="col-lg-3">
                     <img src="http://placehold.it/140x140" alt="...">
                    <div class="caption">
                        <h3>Title</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-default">Button</a></p>
                    </div>
                </div>
                <div class="col-lg-3">
                     <img src="http://placehold.it/140x140" alt="...">
                    <div class="caption">
                        <h3>Title</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-default">Button</a></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <img src="http://placehold.it/140x140" alt="...">
                    <div class="caption">
                        <h3>Title</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-default">Button</a></p>
                    </div>
                </div>
                <div class="col-lg-3">
                     <img src="http://placehold.it/140x140" alt="...">
                    <div class="caption">
                        <h3>Title</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-default">Button</a></p>
                    </div>
                </div>
                <div class="col-lg-3">
                     <img src="http://placehold.it/140x140" alt="...">
                    <div class="caption">
                        <h3>Title</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-default">Button</a></p>
                    </div>
                </div>
                <div class="col-lg-3">
                     <img src="http://placehold.it/140x140" alt="...">
                    <div class="caption">
                        <h3>Title</h3>
                        <p>...</p>
                        <p><a href="#" class="btn btn-default">Button</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="brand-bc">
        <div class="container small-top-padding">
            <h1 class="text-center">What people are saying</h1>
        </div>
    </div>
@stop
