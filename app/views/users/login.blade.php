@extends("layout")

@section("content")
    {{ Form::open([    
        "url"        => "users/login",
        "method"    => "post",
        "autocomplete" => "off"
    ]) }}
        {{ Form::label("username", "Username") }}
        {{ Form::text("username", Input::old("username"), [
            "placeholder" => "john.smith"
        ]) }}
        {{ Form::label("password", "Password") }}
        {{ Form::password("password", [
            "placeholder" => "●●●●●●●●●●"
        ]) }}
        @if ($error = $errors->first("password"))
            <div class="error">
                {{ $error }}
            </div>
        @endif
        {{ Form::submit("login") }}
    {{ Form::close() }}
@stop
