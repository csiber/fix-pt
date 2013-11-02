@extends('promotionpages/layout')

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
        
        @foreach($promotion_pages as $promotion_page)
        <tr>
            <td><? echo $count++; ?>   </td>
            <td>{{ $promotion_page->name }}</td>
            <td>{{ $promotion_page->email}}</td></tr>
        
        @endforeach
    </tbody>
</table>

@stop
