@extends("users/layout")

@section("content")

<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li class="active">Sign In</a></li>
        </ol>
        <div class="well well-lg">
            <h4 class="modal-title">Sign In</h4>
            {{ Form::open(array(    
        "url"        => "users/login",
        "method"    => "post",
        "autocomplete" => "off",
        "id"=> "signin-form"
        )) }}
        <div class="form-group <?php echo ($errors->has('username')) ? "has-error" : ""; ?>">

                <?php echo Form::label("username", ($errors->first('username')) ? "Username - " . $errors->first('username') : "Username", array("class" => "control-label")); ?>
                <?php echo Form::text("username", Input::old("username"), array("placeholder" => "Enter Username", "class" => "form-control", "id" => "username"));
                ?> 

            </div>


            <div class="form-group <?php echo ($errors->has('password')) ? "has-error" : ""; ?>">                        

                <?php echo Form::label("password", ($errors->first('password')) ? "Password - " . $errors->first('password') : "Password", array("class" => "control-label")) ?>
                <?php echo Form::password('password', array("class" => "form-control", "placeholder" => "Password")); ?>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        {{ Form::checkbox('remember', "remember")}}
                        Remember me
                    </label>
                </div>
            </div>
            <div class="form-group">
                <a id="buttonForgotPass" data-toggle="modal" data-target="#resetPassModal" href="#" >Forgot your password?</a>
            </div>
            <button type="submit" form="signin-form" class="btn btn-success">Sign In</button>
            <a class="btn btn-sm btn-primary" href="{{ URL::to('users/fb') }}"><i class="fa fa-facebook-square"></i> Login with Facebook</a>
       
        {{ Form::close() }}
             
        </div>
    </div>
</div>



@stop
