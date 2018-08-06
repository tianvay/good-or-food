<div class="sidebar-module sidebar-module-inset">
    <h4>
        Monster of the day
    </h4>
    <hr>
    @if(isset($monster->name))
        <p>
            {!! $monster->info($monster->name) !!}
        </p>
        <p>
            Read what our Experts have to say about the
            {{ $monster->element }}
            {{ $monster->awakens_from }}
            and
            <a href="<?= url('/monsters/' . $monster->id) ?>">
                join the discussion!
            </a>
            !
        </p>
    @else
        <marquee color="limegreen">
            php artisan set:motd
        </marquee>
    @endif
    <p>
        <a href="<?= url('/featured') ?>">
            List
        </a> of previously featured monsters.
    </p>
</div>
<div class="sidebar-module">
    <h4>Archives</h4>
    <ol class="list-unstyled">

        @foreach($archives as $archive)

            <li>
                <a href="<?= url('/?month=' . $archive['month']) . '&year=' . $archive['year'] ?>">
                    {{ $archive['month'] . ' ' . $archive['year'] }} ({{ $archive['published'] }})
                </a>
            </li>
        @endforeach
    </ol>
</div>
<div class="sidebar-module">
    <h4>Follow us:</h4>
    <ol class="list-unstyled">
        <li>
            <!-- Twitter profile button -->
            <a href="#">
                Twitter
            </a>
        </li>
        <li>
            <!-- Facebook profile button -->
            <a href="#">
                Facebook
            </a>
        </li>
        <li>
            <a href="#">
                YouTube
            </a>
        </li>
        <li>
            <a href="#">
                Twitch
            </a>
        </li>
    </ol>
</div>