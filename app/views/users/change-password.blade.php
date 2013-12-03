@extends('users/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="well well-lg">
            
            <div class="row">
                

                <div class="col-md-8">
                    {{ Form::open(array('action' => 'UserController@postChangePassword', 'id' => 'new-pass')) }}
                        
                       

                        <div class="form-group <?php echo ($errors->has('password')) ? "has-error" : ""; ?>">                        
                            <?php echo Form::label("password", ($errors->first('password')) ? "Password - " . $errors->first('password') : "Password", array("class" => "control-label")) ?>
                            <?php echo Form::password('password', array("class"=>"form-control", "placeholder"=>"Password"));?>
                            
                    
                        </div>
                        <div class="form-group <?php echo ($errors->has('confirm_password')) ? "has-error" : ""; ?>">                        
                            <?php echo Form::label("confirm_password", ($errors->first('confirm_password')) ? "Password - " . $errors->first('confirm_password') : "Confirm Password", array("class" => "control-label")) ?>
                            <?php echo Form::password('confirm_password', array("class"=>"form-control", "placeholder"=>"Confirm Password"));?>
                     
                        </div>
                        <br>
                        <!-- {{ Form::submit('Save') }} -->
                        <button type="submit" form="new-pass" class="btn btn-success">Save</button>
                    {{ Form::close() }}    
                </div>
                
            </div>
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
    @stop

