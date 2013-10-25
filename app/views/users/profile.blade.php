@extends('layout')

@section('content')

<div class="row">
  <div class="col-md-4">.col-md-8</div>
  <div class="col-md-8">.col-md-4</div>
</div>

{{Auth::user()->id}}
{{Auth::user()->username}}
<?php  var_dump(Auth::user());?>
@stop

