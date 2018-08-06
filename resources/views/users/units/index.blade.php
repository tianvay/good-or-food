@extends('reworkedlayout.layout')

@section('content')
    @if(count($monsters))
        @foreach($monsters as $monster)
            <?php $monster = ($monster->getMonster($monster)) ?>
            @include('monsters.monster')
        @endforeach
    @endif
@endsection