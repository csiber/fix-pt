@extends('promotionpages/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('promotionpages/index/recent')}}">Promotion Page</a></li>
            <li class="active">Edit</li>
        </ol>
        <div class="well well-lg">
            {{ Form::open(array(
                "url" => "promotionpages/edit/",
                "id" => "promotionpage-form",
                "role" => "form",
                "files" => true)
            )}}
                <div class="form-group <?php echo ($errors->has('title')) ? "has-error" : ""; ?>">
                    {{ Form::label("title", "Title", array("class" => "control-label")) }}
                    {{ Form::text("title", $promotionpage->title, array("id" => "promotionpage-title","placeholder" => "Enter a short but explicit title",
                        "class" => "form-control"
                    ))}}
                    <p class="help-block"><?php echo $errors->first('title') ?></p>
                </div>
                <div class="form-group form-categories <?php echo ($errors->has('category')) ? "has-error" : ""; ?>">
                    <label style="display: block;" for="category">Category</label>
                    <div class="btn-group" data-toggle="buttons">
                        @if ($promotionpage->category_id == '1')
                        <label class="btn btn-default active">
                        @else
                        <label class="btn btn-default">
                        @endif
                            {{ Form::radio("category", "1", array("id" => "category_1")) }} Home
                        </label>
                        @if ($promotionpage->category_id == '2')
                        <label class="btn btn-default active">
                        @else
                        <label class="btn btn-default">
                        @endif
                            {{ Form::radio("category", "2", array("id" => "category_2")) }} Gardening
                        </label>
                        @if ($promotionpage->category_id == '3')
                        <label class="btn btn-default active">
                        @else
                        <label class="btn btn-default">
                        @endif
                            {{ Form::radio("category", "3", array("id" => "category_3")) }} Mechanics
                        </label>
                        @if ($promotionpage->category_id == '4')
                        <label class="btn btn-default active">
                        @else
                        <label class="btn btn-default">
                        @endif
                            {{ Form::radio("category", "4", array("id" => "category_4")) }} Electronics
                        </label>
                        @if ($promotionpage->category_id == '5')
                        <label class="btn btn-default active">
                        @else
                        <label class="btn btn-default">
                        @endif
                            {{ Form::radio("category", "5", array("id" => "category_5")) }} Appliances
                        </label>
                        <p class="help-block"><?php echo $errors->first('category') ?></p>
                    </div>
                </div>
                <div class="form-group <?php echo ($errors->has('description')) ? "has-error" : ""; ?>">
                    {{ Form::label("body", "Body", array("class" => "control-label")) }}
                    {{ Form::textarea("body", $promotionpage->text, array(
                        "class" => "form-control",
                        "rows" => 20,
                        "placeholder" => "Enter a detailed description of your skills"
                    ))}}
                    <p class="help-block"><?php echo $errors->first('description') ?></p>
                </div>
                <div class="row">
                    
                </div>
                <div class="form-group <?php echo ($errors->has('photo')) ? "has-error" : ""; ?>">
                    {{ Form::label("photos", "Add photos", array("class" => "control-label")) }}
                    {{ Form::file('photos[]', array('multiple' => true))}}
                    <p class="help-block"><?php echo $errors->first('photo') ?></p>
                </div>
                <button type="submit" form="promotionpage-form" class="btn btn-success">Save</button>
            <!-- </form> -->
            {{ Form::close() }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="well well-sm sidebar-steps">
            <h3 class="text-center">How you can make a good promotion page</h1>
            <ol class="sidebar-ol">
                <li>Use a clear title and a detailed description to describe what you can do</li>
                <li>Chose the right category</li>
                <li>Upload some photos to show other works you've done</li>
            </ol>
        </div>
    </div>
</div>
@stop
