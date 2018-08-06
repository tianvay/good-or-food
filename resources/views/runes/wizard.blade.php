@extends('reworkedlayout.layout')

@section('content')
    <p>
        {{ $user->name }}
        joined us
        {{ $user->created_at->diffForHumans() }}.
    </p>
    <p>
        So far, he wrote
        @if($user->posts->count())
            {{ $user->posts->count() }} Posts
            @if($user->comments->count())
                and {{ $user->comments->count() }} Comments.
            @else
                .
            @endif
        @else
            @if($user->comments->count())
                {{ $user->comments->count() }} Comments.
            @else
                nothing at all.
            @endif
        @endif
    </p>
    <p>
        @if(isset($user->json_id))
            A json file is uploaded!
        @endif
    </p>
@endsection