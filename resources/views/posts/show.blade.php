@extends('reworkedlayout.layout')

@section('content')
<div class="blog-post">
    <h2 class="blog-post-title">{{ $post->title }}</h2>
    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }} by <a href="#">{{ $post->user->name }}</a></p>

   <p>
       {!! $post->formatted_body !!}
   </p>
    @if(!auth()->guest())
        @if(auth()->user()->is_admin)
            <hr>
            Delete me?
            <form method="POST" action="/delete/{{ $post->id }}">
                {{ csrf_field() }}
                <input type="checkbox" name="delete">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Delete!</button>
                </div>
            </form>
        @endif
    @endif

    @if(count($post->comments))
        <hr>

        <div class="comments">
            <ul class="list-group">
                @foreach($post->comments as $comment)
                    <li class="list-group-item">
                        <strong>
                            {{ $comment->user->name }}
                        </strong>
                        &nbsp;
                        ({{ $comment->created_at->diffForHumans() }}): &nbsp;
                        {!! $comment->formatted_body !!}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Comment -->

    <hr>

    <div class="card">
        <div class="card-block">
            <form method="POST" action="/posts/{{ $post->id }}/comments">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name="body" placeholder="Dein Kommentar?" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add a Comment!</button>
                </div>
            </form>
            @include('partials.errors')
        </div>
    </div>

</div>
@endsection