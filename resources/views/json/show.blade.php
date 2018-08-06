@extends('reworkedlayout.layout')

@section('content')
    @if(isset($decoded))
        <h2>
            [
            {{ $decoded->wizard_info->wizard_level }}
            ]
            {{ $decoded->wizard_info->wizard_name }}
        </h2>
        <div class="guild">
            Guild:
            {{ $decoded->guild->guild_info->name }}
            (Leader:
            {{ $decoded->guild->guild_info->master_wizard_name }}
            )
            <ul class="guildmembers">
                @foreach($decoded->guild->guild_members as $member)
                    <li class="member">
                        [{{ $member->wizard_level }}]
                        {{ $member->wizard_name }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="alert-danger">
            <a href="{{ url('json/update/' . $json->id) }}">
                Update my runes and monsters!
            </a>
        </div>

        <h3>
            Arena Defense:
        </h3>
        @foreach($decoded->defense_unit_list as $defunit)
            <?php
                if(isset(auth()->user()->wizardid)){
                    $defmonster = \App\Unit::searchByOld($defunit->unit_id);
                    if(isset($defmonster)){
                        $monster = \App\Monster::searchByCom2usid($defmonster->monster_id);
                    }
                }
            ?>
            @include('monsters.monster')

        @endforeach

    @else
        No file decoded.
    @endif
@endsection