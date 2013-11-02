@extends('users/layout')

@section('content')
<pre>
    <?php
//if(isset(Input::old())){
//    $user=Input::old();
//}
    echo $user;
    ?>
</pre>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="well well-lg">
                {{ Form::open(array("url" => "users/edit",
                "id"=>"user-edit","role"=>"form"))}}       
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="form-group <? echo ($errors->has('full_name')) ? "has-error" : ""; ?>">
                    <?php echo Form::label("full_name", ($errors->first('full_name')) ? "Email - " . $errors->first('full_name') : "Full name", array("class" => "control-label")) ?>
                    <?php echo Form::text("full_name", $user->full_name, array("placeholder" => "Enter full name", "class" => "form-control", "id" => "full_name"))
                    ?>

                </div>

                <div class="form-group <? echo ($errors->has('username')) ? "has-error" : ""; ?>">
                    <?php echo Form::label("username", ($errors->first('username')) ? "Username - " . $errors->first('username') : "Username", array("class" => "control-label")); ?>
                    <?php echo Form::text("username", $user->username, array("placeholder" => "Enter Username", "class" => "form-control", "id" => "username", "disabled"));
                    ?> 

                </div>
                <div class="form-group <? echo ($errors->has('email')) ? "has-error" : ""; ?>">
                    <?php echo Form::label("email", ($errors->first('email')) ? "Email - " . $errors->first('email') : "Email", array("class" => "control-label")) ?>
                    <?php echo Form::text("email", $user->email, array("placeholder" => "Enter email", "class" => "form-control", "id" => "email", "disabled"))
                    ?>
                </div>      
                <button type="submit" form="user-edit" class="btn btn-success">Sign Up</button>
                {{ Form::close() }}

            </div>

        </div> 
        <div class="col-md-4">
            <div class="well well-sm sidebar-steps">
                <ul>
                    <li>Links For User Actions TODO</li>                    
                </ul>
            </div>            
        </div>
    </div>
</div>




@stop

