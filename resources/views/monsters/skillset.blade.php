<div class="skillset">
    <!-- Leaderskill -->
    @if(isset($monster->leader_skill))
        <div class="leaderskill">
            <strong>
                Leaderskill
                @if(isset($monster->leader_element))
                    ({{$monster->leader_element}} monsters only)
                @endif
                :
            </strong>
            {{$monster->leader_amount}}
            increased
            {{$monster->leader_attribute}}
            @if(!isset($monster->leader_element))
                ({{$monster->leader_area}})
            @endif
            <hr>
        </div>
    @endif

    <div class="totalskillups">
        <strong>
            A total of
            {{ $monster->skillupstomax() }}
            Skillups are required.
        </strong>
        <hr>
    </div>

    @for($i=1;$i<5;$i++)
        <?php

        $skillname = 's' . $i . 'name';
        $skillpic = 's' . $i . 'pic';
        $description = 's' . $i . 'description';
        $skillups = 's' . $i . 'level_progress_description';
        $cooltime = 's' . $i . 'cd';

        ?>

    <!-- Skillset -->
        @if(isset($monster->$skillname))
            <div class="skill">
                <div class="media">
                    <div class="media-left">
                        <img src="<?= asset('storage/data/images/' . $monster->$skillpic) ?>">
                    </div>
                    <div class="media-body">
                    @if($monster->skillupstoskill($skillups)>0)
                        <h6>
                            {{ $monster->skillupstoskill($skillups) }}
                            Skillups
                        </h6>
                    @endif
                        <div class="h4">
                            {{ $monster->$skillname }}
                        </div>
                        <div class="skilldescription">
                            {{ $monster->$description }}
                        </div>
                        @if(isset($monster->$cooltime))
                            <div class="skillcooltime">
                                Cooldown: {{ $monster->$cooltime }} Turns
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="skillups">
                <?php
                    $skilluparray = explode("xxx", $monster->$skillups);
                ?>
                @foreach($skilluparray as $skillup)
                    @if($skillup != '')

                        <div class="skillupdetail">
                            {{ $skillup }}
                        </div>

                    @else
                        @continue
                    @endif
                @endforeach
            </div>

            <hr>
        @endif
    @endfor

</div>