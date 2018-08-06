<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        G/F ood?
    </title>
    @include('reworkedlayout.reworkedpartial.loadthis')
</head>
<body>
    @include('reworkedlayout.reworkedpartial.topnav')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2">
                @include('reworkedlayout.reworkedpartial.guildside')
            </div>
            <div class="col-sm-8">
                @yield('content')
            </div>
            <div class="col-sm-2 sidenav">
                @include('partials.sidebar')
            </div>
        </div>
    </div>
    @include('reworkedlayout.reworkedpartial.footer')
</body>
</html>