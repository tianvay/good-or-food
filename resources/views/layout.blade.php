@include('partials.loadstuff')

@include('partials.topnav')

@include('partials.header')

<div class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            @yield('content')

        </div><!-- /.blog-main -->

        <div class="col-sm-3 offset-sm-1 blog-sidebar">

            @include('partials.sidebar')

        </div><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</div><!-- /.container -->

@include('partials.footer')
