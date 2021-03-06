@extends('users/layout')

@section('content')
<div class="row">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Fix.pt</a></li>
            <li><a href="{{URL::to('users/index')}}">Users</a></li>
            <li class="active">Edit {{{$user->username}}} info</li>
        </ol>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="well well-lg">            
            <div class="row">
                
                {{ Form::open(array(
                "url" => "users/edit/".$user->id."",
                "id"=>"user-edit",
                "role"=>"form"))}}       
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                
                <div class="form-group <? echo ($errors->has('full_name')) ? "has-error" : ""; ?>">
                    <?php echo Form::label("full_name", ($errors->first('full_name')) ? "Email - " . $errors->first('full_name') : "Full name", array("class" => "control-label")) ?>
                    <?php echo Form::text("full_name", $user->full_name, array("placeholder" => "Enter full name", "class" => "form-control", "id" => "full_name")) ?>

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
                <button type="submit" form="user-edit" class="btn btn-success">Save</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>
@stop

