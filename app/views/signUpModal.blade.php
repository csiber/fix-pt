<!-- SignUp Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header brand-bc">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Sign Up</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array("url" => "users/create",
                "autocomplete" => "off",
                "id"=>"signup-form","role"=>"form"))}}                
                <div class="form-group">
                    {{ Form::label("username", "Name") }}
                    {{ Form::text("username", Input::old("username"), 
                    array("placeholder" => "Enter Username", "class"=>"form-control", "id"=>"username")) }}                        
                </div>
                <div class="form-group">
                    {{ Form::label("email", "Email") }}
                    {{ Form::text("email", Input::old("email"), 
                    array("placeholder" => "Enter email", "class"=>"form-control", "id"=>"email")) }}                        
                </div>
                <div class="form-group"> 
                    {{ Form::label("password", "Password") }}
                    {{ Form::password('password', array("class"=>"form-control", "placeholder"=>"Password"))}}

                </div>
                <div class="form-group">                        
                    {{ Form::label("confirm_password", "Confirm Password") }}
                    {{ Form::password('confirm_password', array("class"=>"form-control", "placeholder"=>"Confirm Password"))}}

                </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="signup-form" class="btn btn-success">Sign Up</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->