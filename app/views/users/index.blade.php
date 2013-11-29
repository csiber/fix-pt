@extends('users/layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-lg">
                {{ Form::open(array("url" => "users/index",
                "id"=>"manage-form1","role"=>"form"))}}
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Permission</th>
                            
                            @if (Auth::user()->user_type == 'Administrator')
                            <th>Actions</th>
                                
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>

                        @foreach($users as $user)
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            @if (Auth::user()->user_type == 'Administrator')
                            <td><a href="{{ URL::to('users/view/'.$user->id.'')}}">{{ $user->full_name }}</a></td>
                            <td><a href="{{ URL::to('users/view/'.$user->id.'')}}">{{ $user->username }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td><?php echo Form::select('user'.$user->id, array('Administrator' => 'Administrator', 'Standard' => 'Standard' , 'Premium' => 'Premium', 'Moderator' => 'Moderator'), $user->user_type); ?></td>
                            @else
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td></td>
                            @endif
                            @if (Auth::user()->user_type == 'Administrator')
                            <td>
                                <a href="{{{ URL::to('users/edit/'.$user->id.'') }}}" class="_users"><span class="label label-fix-pt">Edit</span></a>
                                <a href="{{{ URL::to('users/delete/'.$user->id.'') }}}" class="_users"><span class="label label-danger">Delete</span></a>
                            </td>
                            
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>   
				@if (Auth::user()->user_type == 'Administrator')
                <div>
                    <button type="submit" form="manage-form1" class="btn btn-success">Confirm</button>
                </div>
                @endif
                {{ Form::close() }}
            </div>
        </div>    
    </div>    
</div>
@stop
