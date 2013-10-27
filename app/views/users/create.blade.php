@extends('fixrequests/layout')

@section('content')

</pre>-->
<div class="modal-dialog">
    <div class="modal-content">
        {{ Form::open(array("url" => "users/create",
        "id"=>"signup-form1","role"=>"form"))}} 
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <!-- ./ csrf token -->
        <div class="modal-header">
            <h4 class="modal-title">Sign Up</h4>
        </div>
        <div class="modal-body">

            <div class="form-group <? echo ($errors->has('username')) ? "has-error" : ""; ?>">
                <?php echo Form::label("username", ($errors->first('username')) ? "Username - " . $errors->first('username') : "Username", array("class" => "control-label")); ?>
                <?php echo Form::text("username", Input::old("username"), array("placeholder" => "Enter Username", "class" => "form-control", "id" => "username"));
                ?> 

            </div>
            <div class="form-group <? echo ($errors->has('email')) ? "has-error" : ""; ?>">
                <?php echo Form::label("email", ($errors->first('email')) ? "Email - " . $errors->first('email') : "Email", array("class" => "control-label")) ?>
                <?php echo Form::text("email", Input::old("email"), array("placeholder" => "Enter email", "class" => "form-control", "id" => "email"))
                ?>

            </div>
            <div class="form-group <? echo ($errors->has('password')) ? "has-error" : ""; ?>">                        
                <?php echo Form::label("password", ($errors->first('password')) ? "Password - " . $errors->first('password') : "Password", array("class" => "control-label")) ?>
                <?php echo Form::password('password', array("class"=>"form-control", "placeholder"=>"Password"));?>
                        
                
            </div>
            <div class="form-group  <? echo ($errors->has('confirm_password')) ? "has-error" : ""; ?>">                        
                <?php echo Form::label("confirm_password", ($errors->first('confirm_password')) ? "Password - " . $errors->first('confirm_password') : "Confirm Password", array("class" => "control-label")) ?>
                <?php echo Form::password('confirm_password', array("class"=>"form-control", "placeholder"=>"Confirm Password"));?>
                 
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" form="signup-form1" class="btn btn-success">Sign Up</button>

        </div>
        {{ Form::close() }}
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


@stop