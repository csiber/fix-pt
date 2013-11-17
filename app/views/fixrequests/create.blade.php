@extends('fixrequests/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('fixrequests/index/recent')}}">Fix Requests</a></li>
            <li class="active">Create new</li>
        </ol>
        <div class="well well-lg">
            {{ Form::open(array(
                "url" => "fixrequests/create",
                "id" => "fixrequest-form",
                "role" => "form",
                "files" => true)
            )}}
                <div class="form-group <?php echo ($errors->has('title')) ? "has-error" : ""; ?>">
                    {{ Form::label("title", "Title", array("class" => "control-label")) }}
                    {{ Form::text("title", Input::old('title'), array(
                        "id" => "fixrequest-title",
                        "placeholder" => "enter a short but explicit title",
                        "class" => "form-control"
                    ))}}
                    <p class="help-block"><?php echo $errors->first('title') ?></p>
                </div>
                <div class="form-group <?php echo ($errors->has('description')) ? "has-error" : ""; ?>">
                    {{ Form::label("description", "Description", array("class" => "control-label")) }}
                    {{ Form::textarea("description", "", array(
                        "class" => "form-control",
                        "rows" => 6,
                        "placeholder" => "enter a detailed description of the task"
                    ))}}
                    <p class="help-block"><?php echo $errors->first('description') ?></p>
                </div>
                <div class="form-group form-categories <?php echo ($errors->has('category')) ? "has-error" : ""; ?>">
                    <label style="display: block;" for="category">Category</label>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default">
                            {{ Form::radio("category", "1", array("id" => "category_1")) }} Home
                        </label>
                        <label class="btn btn-default">
                            {{ Form::radio("category", "2", array("id" => "category_2")) }} Gardening
                        </label>
                        <label class="btn btn-default">
                            {{ Form::radio("category", "3", array("id" => "category_3")) }} Mechanics
                        </label>
                        <label class="btn btn-default">
                            {{ Form::radio("category", "4", array("id" => "category_4")) }} Electronics
                        </label>
                        <label class="btn btn-default">
                            {{ Form::radio("category", "5", array("id" => "category_5")) }} Appliances
                        </label>
                        <p class="help-block"><?php echo $errors->first('category') ?></p>
                    </div>
                </div>
                <div class="form-group <?php echo ($errors->has('tags')) ? "has-error" : ""; ?>">
                    {{ Form::label("tags", "Tags", array("class" => "control-label")) }}
                    {{ Form::text("tags", "", array(
                        "id" => "fixrequest-tags",
                        "placeholder" => "",
                        "class" => "form-control",
                        "data-role" => "tagsinput"
                    ))}}
                    <?php
                        echo ($errors->has('tags')) ? '<p class="help-block">'.$errors->first('tags').'</p>' : '<p class="help-block">At least 1 tag, maximum is 5. Press enter or comma to add it.</p>';
                    ?>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group <?php echo ($errors->has('city')) ? "has-error" : ""; ?>">
                        {{ Form::label("city", "City", array("class" => "control-label")) }}
                        {{ Form::text("city", "", array(
                            "class" => "form-control",
                            "id" => "fixrequest-city",
                            "placeholder" => "Enter city"
                        ))}}
                        <p class="help-block"><?php echo $errors->first('city') ?></p>
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group <?php echo ($errors->has('location')) ? "has-error" : ""; ?>">
                        {{ Form::label("location", "Location", array("class" => "control-label")) }}
                        {{ Form::text("location", "", array(
                            "class" => "form-control",
                            "id" => "fixrequest-location",
                            "placeholder" => "Enter location"
                        ))}}
                        <p class="help-block"><?php echo $errors->first('location') ?></p>
                    </div>
                    </div>
                </div>
                <div class="form-group <?php echo ($errors->has('daysForOffer')) ? "has-error" : ""; ?>">
                    {{ Form::label("daysForOffer", "Available time to receive offers", array("class" => "control-label")) }}
                    {{ Form::select("daysForOffer", array(
                        "1" => "1 day",
                        "2" => "2 days",
                        "3" => "3 days",
                        "5" => "5 days",
                        "8" => "8 days",
                        "13" => "13 days"
                    ), null, array("class" => "form-control"))}}
                    <p class="help-block"><?php echo $errors->first('daysForOffer') ?></p>
                </div>
                <div class="form-group <?php echo ($errors->has('value')) ? "has-error" : ""; ?>">
                    {{ Form::label("value", "Available budget", array("class" => "control-label")) }}
                    <div class="input-group">
                        {{ Form::text("value", "", array(
                        "class" => "form-control",
                        "placeholder" => "0,00",
                        "id" => "fixrequest-value"
                        ))}}
                        <span class="input-group-addon">€</span>
                    </div>
                    <p class="help-block"><?php echo $errors->first('value') ?></p>
                </div>
                <!-- <div class="form-group <?php echo ($errors->has('photos')) ? "has-error" : ""; ?>">
                    {{ Form::label("photos", "Add photos", array("class" => "control-label")) }}
                    {{ Form::file('photos[]', array('multiple' => true))}}
                    <p class="help-block"><?php echo $errors->first('photos') ?></p>
                </div> -->
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
