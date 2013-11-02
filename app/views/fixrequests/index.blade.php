@extends('fixrequests/layout')

@section('content')
<div class="row">
    <div class="col-md-9">
        <ol class="breadcrumb">
            <li><a href="#">Fix.pt</a></li>
            <li class="active">Fix Requests</li>
        </ol>
        <div class="well well-lg">
            <table class="table">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Title</td>
                        <td>Text</td>
                        <td>Posted by</td>
                        <td>Date</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1;?>

                    @foreach($fixrequests as $request)
                    <tr>
                        <td><?php echo $count++; ?> </td>
                        <td>Sem titulo</td>
                        <td>{{ $request->text}}</td>
                        <td>{{ $request->name}}</td>
                        <td>{{ $request->creation_date}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading brand-bc">
                <h3 class="panel-title">Favorite Tags</h3>
            </div>
            <div class="panel-body">
                This will show the favorite tags of the user
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading brand-bc">
                <h3 class="panel-title">Popular Tags</h3>
            </div>
            <div class="panel-body">
                This will show the most used tags
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading brand-bc">
                <h3 class="panel-title">Recent Tags</h3>
            </div>
            <div class="panel-body">
                This will show the most recent used tags
            </div>
        </div>
</div>

@stop
