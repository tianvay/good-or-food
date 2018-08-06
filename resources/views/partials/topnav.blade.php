<div class="blog-masthead">
    <div class="container">
        <nav class="nav blog-nav">
            <a class="nav-link{{ Request::path() == '/' ? ' active' : ''}}" href="<?= url('/') ?>">
                Articles
            </a>
            <a class="nav-link{{ Request::path() == 'tasks' ? ' active' : '' }}" href="<?= url('/tasks') ?>">
                Roadmap
            </a>
            <a class="nav-link{{ Request::path() == 'monsters' ? ' active' : ''}}" href="<?= url('/monsters') ?>">
                Monsters
            </a>
            <a class="nav-link{{ Request::path() == 'runes' ? ' active' : ''}}" href="<?= url('/runes') ?>">
                Runeguide
            </a>
            @if(Auth::check())
                @if(auth()->user()->is_admin)
                    <a class="nav-link{{ Request::path() == 'posts/create' ? ' active' : ''}}" href="<?= url('/posts/create') ?>">
                        Write!
                    </a>
                    <a class="nav-link{{ Request::path() == 'review' ? ' active' : ''}}" href="<?= url('/review') ?>">
                        Review!
                    </a>
                @endif
            @endif

            <!-- User not authenticated? Login/Register him! -->
            @if(!auth()->check())
                <a class="nav-link ml-auto{{ Request::path() == 'login' ? ' active' : ''}}" href="<?= url('/login') ?>">
                    Login
                </a>

                <a class="nav-link ml-auto{{ Request::path() == 'register' ? ' active' : ''}}" href="<?= url('register') ?>">
                    Register
                </a>
            @endif
            <!-- User is already logged in? Greet him! -->
            @if(aut()->check())

                <div class="dropdown">
                    <button class="dropbtn">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-content">
                        <a href="{{ url('/users/' . auth()->user()->name ) }}">
                            Profile
                        </a>
                        <a href="{{ url('/users/' . auth()->user()->name . '/units' ) }}">
                            My Units
                        </a>
                        @if(auth()->user()->json_id == null)
                            <a href="{{ url('/upload') }}">JSON Upload</a>
                        @else

                        @endif
                        <a href="{{ url('/json/' . auth()->user()->id) }}">JSON Action!</a>
                        <a href="{{ url('/logout') }}">Logout</a>
                    </div>
                </div>
            @endif
        </nav>
    </div>
</div>