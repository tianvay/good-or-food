@extends('reworkedlayout.layout')

@section('content')
    <div class="container">
        {{ $user->name }}
        joined us
        {{ $user->created_at->diffForHumans() }}.
    </div>
    <div class="container">
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
    </div>
    <p>
        @if(isset($user->json_id))
            <div class="container">
                A json file is uploaded! Delete it before you can upload a new one!
            </div>
            <form method="POST" action="{{ url('/json/delete/' . $user->json_id ) }}">
                {{ csrf_field() }}
                <div class="container">
                    <input type="submit" value="Delete">
                </div>
            </form>
        @endif
    </p>
@endsection