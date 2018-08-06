@extends('reworkedlayout.layout')

@section('content')
<h1>
    {{ $task->title }}
</h1>
<p>
    {!! $task->formatted_body !!}
</p>
@if($task->completed)
    Completed!
@else
    Not Completed!
@endif

@endsection