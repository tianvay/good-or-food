<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="<?= url('/posts/' . $post->id) ?>">
            {{ $post->title }}
        </a>
    </h2>
    <p class="blog-post-meta">
        {{ $post->created_at->diffForHumans() }}
        by
        <a href="#">
            {{ $post->user->name }}
        </a>
    </p>

    <p>
        {!! $post->formatted_body !!}
    </p>
    @if(!$post->published)
        Needs review!
        <form method="POST" action="{{ url('/review/' . $post->id) }}">
            {{ csrf_field() }}
            <input type="checkbox" name="publish">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish!</button>
            </div>
        </form>
    @else
        <p>
            Full Story? <a href="<?= url('/posts/' . $post->id) ?>">Clicky</a>
        </p>
    @endif
    @if(count($post->comments))
        <p>
            {{ count($post->comments) }} Kommentar{{ count($post->comments) ==1 ? '' : 'e' }}
        </p>
    @endif

</div>