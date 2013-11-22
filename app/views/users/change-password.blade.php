@extends('users/layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="well well-lg">
            
            <div class="row">
                

                <div class="col-md-8">
                    {{ Form::open(array('action' => 'UserController@postChangePassword')) }}
                        
                        {{ Form::label('New Password') }}
                        {{ Form::password('newPass') }} <br>
                        {{ Form::submit('Save') }}
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
