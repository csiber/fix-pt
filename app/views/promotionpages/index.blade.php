@extends('promotionpages/layout')

@section('content')
<table class="table">
    <thead>
        <tr>
            <td>#</td>
            <td>Title</td>
            <td>Body</td>
            <td>Location</td>
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

@stop
