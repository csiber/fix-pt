@extends('layout')

@section('content')

<h2>User Profile</h2>

{{Auth::user()->id}}
{{Auth::user()->username}}

@stop

