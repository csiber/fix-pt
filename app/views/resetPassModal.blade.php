<div class="modal fade" id="resetPassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header brand-bc">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Lost Password</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array(
                    "url" => "users/reset-pass",
                    "id" => "resetPass-form",
                    "role" => "form")) }}                
                <div class="form-group">
                    {{ Form::text("email", Input::old("email"), 
                    array("placeholder" => "email", "class" => "form-control")) }}
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Send request to reset password</button>
                </div>
                {{ Form::close() }}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->