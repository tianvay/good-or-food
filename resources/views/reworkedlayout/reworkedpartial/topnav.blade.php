<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                G/F ood?
            </a>
        </div>
        <ul class="nav navbar-nav">
            <li class="{{ Request::path() == '/' ? 'active' : ''}}">
                <a href="{{ url('/') }}">
                    Articles
                </a>
            </li>
            <li class="{{ Request::path() == 'tasks' ? 'active' : '' }}" >
                <a href="<?= url('/tasks') ?>">
                    Roadmap
                </a>
            </li>
            <li class="{{ Request::path() == 'monsters' ? 'active' : ''}}" >
                <a href="<?= url('/monsters') ?>">
                    Monsters
                </a>
            </li>
            <li class="{{ Request::path() == 'runes' ? 'active' : ''}}" >
                <a href="<?= url('/runes') ?>">
                    Runeguide
                </a>
            </li>
            @if(auth()->check())
                <!-- User is logged in -->
                @if(auth()->user()->is_admin)
                    <!-- User is admin -->
                    <li class="{{ Request::path() == 'posts/create' ? 'active' : ''}}" >
                        <a href="<?= url('/posts/create') ?>">
                            Write!
                        </a>
                    </li>
                    <li class="{{ Request::path() == 'review' ? 'active' : ''}}" >
                        <a href="<?= url('/review') ?>">
                            Review!
                        </a>
                    </li>
                @endif
            @endif
            @if(!auth()->check())
                <!-- User is not logged in -->
                <li class="{{ Request::path() == 'login' ? 'active' : ''}}" >
                    <a href="<?= url('/login') ?>">
                        Login
                    </a>
                </li>
                <li class="{{ Request::path() == 'register' ? 'active' : ''}}" >
                    <a href="<?= url('register') ?>">
                        Register
                    </a>
                </li>
            @else
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        {{ auth()->user()->name }}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('/users/' . auth()->user()->name ) }}">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/users/' . auth()->user()->name . '/units' ) }}">
                                My Units
                            </a>
                        </li>
                        @if(auth()->user()->json_id == null)
                            <!-- User has no json uploaded -->
                            <li>
                                <a href="{{ url('/upload') }}">
                                    JSON Upload
                                </a>
                            </li>
                        @endif
                        @if(!auth()->user()->json_id == null)
                            <li>
                                <a href="{{ url('/json/' . auth()->user()->json_id) }}">
                                    JSON Action!
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ url('/logout') }}">
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>


    </div>
</nav>