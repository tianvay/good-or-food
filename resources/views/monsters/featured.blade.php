@extends('reworkedlayout.layout')

@section('content')
    <div class="media">
        @foreach($featured as $monster)
            @include('monsters.monster')
        @endforeach
    </div>
@endsection