@extends('fixrequests/layout')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="well well-lg">
                {{ Form::open(array(
                    "url" => "fixrequests/create",
                    "id" => "fixrequest-form",
                    "role" => "form",
                    "files" => true)
                )}}
                <!-- <form id="fix-request-form" action="{{ URL::to('fixrequests/create') }}" role="form" method="POST">
                    {{ Form::token() }} -->
                    <div class="form-group">
                        {{ Form::label("title", "Title") }}
                        {{ Form::text("title", "", array(
                            "id" => "fixrequest-title",
                            "placeholder" => "Enter title",
                            "class" => "form-control"
                        ))}}
                    </div>
                    <div class="form-group">
                        <label style="display: block;" for="exampleInputEmail1">Category</label>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary">
                                {{ Form::radio("category", "1", array("id" => "option1")) }} Category 1
                            </label>
                            <label class="btn btn-primary">
                                {{ Form::radio("category", "2", array("id" => "option1")) }} Category 2
                            </label>
                            <label class="btn btn-primary">
                                {{ Form::radio("category", "3", array("id" => "option1")) }} Category 3
                            </label>
                            <label class="btn btn-primary">
                                {{ Form::radio("category", "4", array("id" => "option1")) }} Category 4
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label("description", "Description") }}
                        {{ Form::textarea("description", "", array(
                            "class" => "form-control",
                            "rows" => 6,
                            "placeholder" => "Enter description"
                        ))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label("tags", "Tags") }}
                        {{ Form::text("tags", "", array(
                            "id" => "fixrequest-tags",
                            "placeholder" => "Enter at least 1 tag, maximum is 3",
                            "class" => "form-control",
                            "data-role" => "tagsinput"
                        ))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label("city", "City") }}
                        {{ Form::text("city", "", array(
                            "class" => "form-control",
                            "id" => "fixrequest-city",
                            "placeholder" => "Enter city"
                        ))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label("daysForOffer", "Days to receive offer") }}
                        {{ Form::select("daysForOffer", array(
                            "1" => 1,
                            "2" => 2,
                            "3" => 3,
                            "4" => 4,
                            "5" => 5
                        ), null, array("class" => "form-control"))}}
                    </div>
                    <div class="form-group">
                        {{ Form::label("value", "Value") }}
                        {{ Form::text("value", "", array(
                            "class" => "form-control",
                            "placeholder" => "0,00",
                            "id" => "fixrequest-value"
                        ))}}
                    </div>
                    <div class="form-group">
                        <!-- {{ Form::label("photos", "Add photos") }}
                        {{ Form::file('photos[]', array('multiple' => true))}} -->
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                <!-- </form> -->
                {{ Form::close() }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="well well-sm sidebar-steps">
                <ul>
                    <li>Describe the work that you need to be done</li>
                    <li>Receive fix offers from our fixers</li>
                    <li>Compare and chose the best</li>
                </ul>
            </div>
        </div>
    </div>
@stop
