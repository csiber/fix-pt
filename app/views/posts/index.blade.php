@extends('layout')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Text</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 1;?>
        
        @foreach($postsArray as $post)
        <tr>
            <td><? echo $count++; ?>   </td>
            <td>{{ $post->name }}</td>
            <td>{{ $post->email}}</td></tr>
        
        @endforeach
    </tbody>
</table>

@stop
