@extends('reworkedlayout.layout')

@section('content')
    @if(count($monsters))
            {{ $monsters->appends(['name' => $name, 'element' => $element])->links() }}
        <hr>
        @if($monsters->total()>1)
            <p>
                Filters:
                ({{ $monsters->total() }}
                remaining)
            </p>
        @endif
        @include('monsters.filter')
        <div class="media">
            @foreach($monsters as $monster)
                @include('monsters.monster')
            @endforeach
        </div>
    @else
        php artisan migrate:monsters
    @endif
@endsection