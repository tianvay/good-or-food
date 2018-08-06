<!-- only visible when:
    logged in
    json uploaded
    in guild
-->
@if(isset(auth()->user()->guild_id))
    <div class="sidebar-module sidebar-module-inset">
        <h4>
            {{ auth()->user()->guild->name }}
        </h4>
        <hr>
        <div class="alert-warning">
            {{ auth()->user()->guild->internalinfo }}
        </div>
    </div>
    <div class="sidebar-module">
        <h4>
            Guild Info:
        </h4>
        <div class="alert-success">
            {{ auth()->user()->guild->publicinfo }}
        </div>
    </div>
    <div class="sidebar-module">
        <h4>
            Guild Members
        </h4>
        <?php
            # get Guild
            $guild = App\Guild::find(auth()->user()->guild_id);

            # get guild members for iteration
            $members = App\Guild::getMembers(auth()->user()->guild_id);
        ?>
        <ol class="list-unstyled">
            @foreach($members as $member)
                <li class="guildmember">
                    {{ $member->name }}
                </li>
            @endforeach
        </ol>
    </div>
@endif