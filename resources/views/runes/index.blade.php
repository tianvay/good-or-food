@extends('reworkedlayout.layout')

@section('content')
    @if(count($runes))
        <h2>My runes!</h2>
        <hr>
        <?php
        $i = 0;
        // change if needed:
        $runesPerRow = 3;
        ?>
        <div class="row runes center-block">
        @foreach($runes as $rune)
            <?php $i++ ?>

            <div class="col-sm-1 rune-visualization container">
                <img class="rune-background" src="{{ asset('storage/data/images/rune_background_' . $rune->class . '.png')  }}">
                <img class="rune-slot slot-{{ $rune->slot }}" src="{{ asset('storage/data/images/rune_slot_' . $rune->slot . '.png')  }}">
                <img class="rune-type" src="{{ asset('storage/data/images/rune_type_' . strtolower($rune->set) . '.png')  }}">
                <div class="rune-rating text-center">
                    <div class="type">
                        {{ $rune->set }}
                    </div>
                    <div class="stars">
                        @for($k=0;$k<$rune->stars;$k++)
                            ⭐
                        @endfor
                    </div>
                    <div class="rating">
                        Efficiency:
                    </div>
                    <div class="rating-value">
                        {{ App\Rune::efficiency($rune) }}%
                    </div>
                </div>
            </div>
            <div class="col-sm-2 rune">
                <ul class="list-unstyled list-group">
                    <li class="list-group-item mainstat">
                        <div class="stat">
                            {{ $rune->mainstat }}:
                        </div>
                        <div class="stat-value">
                            {{ $rune->mainstat_value }}
                        </div>
                    </li>
                    @if($rune->innate_value>0)
                        <li class="innate list-group-item">
                            <div class="stat">
                                {{ $rune->innate }}:
                            </div>
                            <div class="stat-value">
                                {{ $rune->innate_value }}
                            </div>
                        </li>
                    @endif
                    <div class="substats">
                        @for($j=1;$j<5;$j++)
                            <?php
                                $substat = 'substat' . $j;
                                $substat_value = 'substat' . $j . '_value';
                                $substat_grind = 'substat' . $j . '_grind';
                            ?>
                            @if($rune->$substat_value>0)
                                <li class="substat list-group-item">
                                    <div class="stat">
                                        {{ $rune->$substat }}:
                                    </div>
                                    <div class="stat-value">
                                        {{ $rune->$substat_value }}
                                        {{ $rune->$substat_grind > 0 ? ' (+' . $rune->$substat_grind . ')' : '' }}
                                    </div>
                                </li>
                            @endif
                        @endfor
                    </div>
                </ul>
            </div>

            @if($i==$runesPerRow)
                <?php $i = 0 ?>
                </div>
            <hr>
                <div class="row runes center-block">
            @else
            @endif
        @endforeach
        </div>
    @else
        <div class="container">
            You need to upload a json file first. If you've done that, click on your name on top and then JSON Action!
        </div>
    @endif
@endsection