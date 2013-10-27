@extends('users/layout')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Permission</th>
        </tr>
    </thead>
    <tbody>
        <?php $counter = 1; ?>
        
        @foreach($users as $user)
        <tr>
            <td><?php echo $counter++; ?></td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->permission }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop
