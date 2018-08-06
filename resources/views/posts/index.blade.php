@extends('reworkedlayout.layout')

@section('content')
                @if(count($posts))
                    @foreach($posts as $post)
                        @include('posts.post')
                    @endforeach
                @else
                    No posts yet
                @endif
@endsection