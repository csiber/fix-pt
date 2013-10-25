@extends('fixrequests/layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                {{Form::open(array(
                    "autocomplete" => "on",
                    "url" => "fixrequests/create" ))}}

                <form id="signup-form" role="form">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" id="" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category</label>
                    <input type="text" class="form-control" id="" placeholder="Enter category">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Tags</label>
                    <input type="text" class="form-control" id="" placeholder="Enter category">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">City</label>
                    <input type="text" class="form-control" id="" placeholder="Enter category">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Location</label>
                    <input type="text" class="form-control" id="" placeholder="Enter category">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Days to receive offer</label>
                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Value</label>
                    <input type="number" class="form-control" value="5" id="">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Add photos</label>
                    <input type="file" id="exampleInputFile">
                    <p class="help-block">Example block-level help text here.</p>
                </div>
            </form>
            </div>
            <div class="col-md-4">
                Help text can be added to this sidebar
            </div>
        </div>
    </div>
@stop
