<div class="monster monster-article">

    @if(isset($monster->article))
        <hr>
        <p>
            {!! $monster->formatted_article !!}
        </p>
    @else
        @if(auth()->guest())
        <!-- User not logged in -->
        @elseif(auth()->user()->is_admin)
        <!-- User is logged in and is admin -->
            <hr>
            @include('monsters.write')
        @endif
    @endif
</div>
<hr>