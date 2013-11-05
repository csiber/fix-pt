<!-- Sign In Modal -->
<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header brand-bc">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">User Login</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array(
                    "url" => "users/login",
                    "id" => "login-form",
                    "role" => "form")) }}                
                <div class="form-group">
                    {{ Form::text("username", Input::old("username"), 
                    ["placeholder" => "username", "class" => "form-control"]) }}
                </div>
                <div class="form-group">
                    {{ Form::password("password", ["placeholder" => "Password",
                    "class"=>"form-control input-sm"]) }}
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
                    <a href="#">Forgot your password?</a>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
                {{ Form::close() }}
            </div>
            <div class="modal-footer">
                <a class="btn btn-sm btn-primary" href="{{ URL::to('users/fb') }}"><i class="fa fa-facebook-square"></i> Login with Facebook</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->