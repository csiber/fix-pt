@extends('layout')

@section('content')
	@foreach($usersArray as $user)
		<p>{{ $user->name }}</p>
	@endforeach
@stop
               