@extends("users/layout")

@section("content")
<div class="modal-dialog">
    <div class="modal-content">
        {{ Form::open(array(    
        "url"        => "users/reset-pass",
        "method"    => "post",
        "autocomplete" => "off",
        "id"=> "resetPass-form"
        )) }}

        <div class="modal-header">
            <h4 class="modal-title">Lost Password</h4>
        </div>
        <div class="modal-body">


            <div class="form-group <?php echo ($errors->has('email')) ? "has-error" : ""; ?>">

                <?php echo Form::label("email", 
                    ($errors->first('email')) ? "email - " . $errors->first('email') : "email", 
                        array("class" => "control-label")); 
                ?>
                <?php echo Form::text("email", Input::old("email"), 
                    array("placeholder" => "Enter email", "class" => "form-control", "id" => "email"));
                ?> 

            </div>


        </div>
        <div class="modal-footer">
            <button type="submit" form="resetPass-form" class="btn btn-success">
                Send request to reset password
            </button>
        </div>
        {{ Form::close() }}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

@stop
