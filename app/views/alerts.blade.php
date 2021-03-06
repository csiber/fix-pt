@if (count($errors->all()) > 0)
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Error</h4>
    Please check the form below for errors
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>    
    @if(is_array($message))
    @foreach ($message as $m)
        {{ $m }}<br/>
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    @if(is_array($message))
    @foreach ($message as $m)
        {{ $m }}<br/>
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>    
    @if(is_array($message))
    @foreach ($message as $m)
        {{ $m }}<br/>
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>    
    @if(is_array($message))
    @foreach ($message as $m)
        {{ $m }}<br/>
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

