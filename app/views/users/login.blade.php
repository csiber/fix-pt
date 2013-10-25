@extends("layout")

@section("content")
<div class="modal-dialog">
    <div class="modal-content">
        {{ Form::open([    
        "url"        => "users/login",
        "method"    => "post",
        "autocomplete" => "off",
        "id"=> "signin-form"
        ]) }}

        <div class="modal-header">
            <h4 class="modal-title">Sign In</h4>
        </div>
        <div class="modal-body">

            <div class="form-group <?phpecho ($errors->has('username')) ? "has-error" : ""; ?>">
                <?php echo Form::label("username", ($errors->first('username')) ? "Username - " . $errors->first('username') : "Username", array("class" => "control-label")); ?>
                <?php echo Form::text("username", Input::old("username"), array("placeholder" => "Enter Username", "class" => "form-control", "id" => "username"));
                ?> 

            </div>

            <div class="form-group <?php echo ($errors->has('password')) ? "has-error" : ""; ?>">                        
                <?php echo Form::label("password", ($errors->first('password')) ? "Password - " . $errors->first('password') : "Password", array("class" => "control-label")) ?>
                <?php echo Form::password('password', array("class" => "form-control", "placeholder" => "Password")); ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" form="signin-form" class="btn btn-success">Sign In</button>
        </div>
        {{ Form::close() }}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

@stop
