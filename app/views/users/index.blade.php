@extends('layout')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 1;?>
        
        @foreach($users as $user)
        <tr>
            <td><? echo $count++; ?>   </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email}}</td></tr>
        
        @endforeach
    </tbody>
</table>

@stop
