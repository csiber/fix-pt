@extends('fixrequests/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="#">Fix.pt</a></li>
            <li><a href="#">Fix Requests</a></li>
            <li class="active">Create new</li>
        </ol>
        <div class="well well-lg">
            {{ Form::open(array(
                "url" => "fixrequests/create",
                "id" => "fixrequest-form",
                "role" => "form",
                "files" => true)
            )}}
                <div class="form-group">
                    {{ Form::label("title", "Title") }}
                    {{ Form::text("title", "", array(
                        "id" => "fixrequest-title",
                        "placeholder" => "enter a short but explicit title",
                        "class" => "form-control"
                    ))}}
                </div>
                <div class="form-group">
                    {{ Form::label("description", "Description") }}
                    {{ Form::textarea("description", "", array(
                        "class" => "form-control",
                        "rows" => 6,
                        "placeholder" => "enter a detailed description of the task"
                    ))}}
                </div>
                <div class="form-group">
                    <label style="display: block;" for="exampleInputEmail1">Category</label>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            {{ Form::radio("category", "1", array("id" => "category_1")) }} Home/Garden
                        </label>
                        <label class="btn btn-primary">
                            {{ Form::radio("category", "2", array("id" => "category_2")) }} Mechanics
                        </label>
                        <label class="btn btn-primary">
                            {{ Form::radio("category", "3", array("id" => "category_3")) }} Electronics
                        </label>
                        <label class="btn btn-primary">
                            {{ Form::radio("category", "4", array("id" => "category_4")) }} Appliances
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label("tags", "Tags") }}
                    {{ Form::text("tags", "", array(
                        "id" => "fixrequest-tags",
                        "placeholder" => "Enter at least 1 tag, maximum is 3",
                        "class" => "form-control",
                        "data-role" => "tagsinput"
                    ))}}
                    <p class="help-block">Enter at least 1 tag, maximum is 3</p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                        {{ Form::label("city", "City") }}
                        {{ Form::text("city", "", array(
                            "class" => "form-control",
                            "id" => "fixrequest-city",
                            "placeholder" => "Enter city"
                        ))}}
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        {{ Form::label("location", "Location") }}
                        {{ Form::text("location", "", array(
                            "class" => "form-control",
                            "id" => "fixrequest-location",
                            "placeholder" => "Enter location"
                        ))}}
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label("daysForOffer", "Available time to receive offers") }}
                    {{ Form::select("daysForOffer", array(
                        "1" => "3 days",
                        "2" => "1 day",
                        "3" => "1 week",
                        "4" => "2 weeks",
                        "5" => "1 month"
                    ), null, array("class" => "form-control"))}}
                </div>
                <div class="form-group">
                    {{ Form::label("value", "Available budget") }}
                    <div class="input-group">
                        {{ Form::text("value", "", array(
                        "class" => "form-control",
                        "placeholder" => "0,00",
                        "id" => "fixrequest-value"
                        ))}}
                        <span class="input-group-addon">€</span>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label("photos", "Add photos") }}
                    {{ Form::file('photos[]', array('multiple' => true))}}
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            <!-- </form> -->
            {{ Form::close() }}
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
