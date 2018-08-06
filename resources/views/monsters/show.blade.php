@extends('reworkedlayout.layout')

@section('content')
    <div class="media">
        <div class="media-left monsterpic">
            <img src="<?= asset('storage/data/images/' . $monster->pic) ?>">
        </div>
        <div class="media-body">
            <h3 class="blog-post-title">{{ $monster->name }}</h3>
            @if(isset($monster->awakens_from))
            <h4 class="blog-post-meta">
                The
                {{ $monster->element }}
                {{ $monster->awakens_from }}
            </h4>
            @elseif(isset($monster->awakens_to))
                <h4 class="blog-post-meta">
                    Awakens to
                    {{ $monster->awakens_to }},
                    the
                    {{ $monster->element }}
                    {{ $monster->name }}
                </h4>
            @else
                <h4 class="blog-post-meta">
                    A special Monster!
                </h4>
            @endif
        </div>
    </div>
    <p>
        @include('monsters.monsterbrolinks')
    </p>
    <hr>
    @include('monsters.skillset')
    @include('monsters.skilleffects')
    @include('monsters.article')
@endsection