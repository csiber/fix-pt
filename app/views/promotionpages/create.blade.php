@extends('promotionpages/layout')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8">

                {{Form::open(array(
                    "autocomplete" => "on",
                    "url" => "fixrequests/create" ))}}

                <form id="promotionpage-form" role="form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" id="" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Body</label>
                    <textarea class="form-control" rows="20" placeholder="Enter text here"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Location</label>
                    <input type="text" class="form-control" id="" placeholder="Enter your location">
                </div>
            </form>
            </div>
            <div class="col-md-4">
                Help text can be added to this sidebar
            </div>
        </div>
    </div>
@stop
