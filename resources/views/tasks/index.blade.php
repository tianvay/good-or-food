@extends('reworkedlayout.layout')

@section('content')
    <h2>What you should be doing</h2>
<list>
    @foreach($tasks as $task)
        <li>
            <a href="<?= url('/tasks/' . $task->id) ?>">{{ $task->title }}
                (
                @if($task->completed)
                    Completed
                @else
                    Not Completed
                @endif
                )
            </a>
        </li>
    @endforeach
</list>
@endsection