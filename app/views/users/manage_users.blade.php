@extends('users/layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-lg">
                {{ Form::open(array("url" => "users/manage_users",
                "id"=>"manage-form1","role"=>"form"))}} 
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
                            <td><?php echo Form::select($user->id, array('Administrator' => 'Administrator', 'Standard' => 'Standard' , 'Premium' => 'Premium', 'Moderator' => 'Moderator'), $user->user_type); ?></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    <button type="submit" form="manage-form1" class="btn btn-success">Confirm</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>    
    </div>    
</div>
@stop
