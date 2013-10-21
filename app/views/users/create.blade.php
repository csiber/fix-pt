@extends('layout')

@section('content')
{{ Form::open(array('url' => 'users/create')) }}
echo Form::text('username');
echo Form::email($name, $value = null, $attributes = array());
echo Form::password('password');
{{ Form::close() }}
@stop