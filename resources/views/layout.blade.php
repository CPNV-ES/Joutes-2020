<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Joutes</title>

    <script src="{{ asset('/lib/jquery/jquery.min.js') }}"></script>
    <link href="{{ asset('/lib/font-awesome/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet" type="text/css" />

</head>


<body class="preload">

    <!-- Side Navbar -->
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="sideNavbar">
            <div class="navContent">
                <div class="custom-menu">
                    <button type="button" id="sidebarCollapse" class="btn btnCollapseNavbar">
                        <i class="fa fa-bars fa-lg"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                </div>

                <a class="navbar-brand" href="{{ route('homepage') }}">
                    <img class="joutesLogo" src="{{ asset('images/logo.png') }}" alt>
                </a>
                <ul class="list-unstyled components mb-5">
                    <li class="@if (Route::is('events.index')) active @endif"><a href="{{ route('events.index') }}">
                            <i class="fa fa-calendar" aria-hidden="true"></i> Evénements</a></li>
                    <li class="@if (Route::is('tournaments.index')) active @endif"><a
                            href="{{ route('tournaments.index') }}"> <i class="fa fa-trophy" aria-hidden="true"></i>
                            Tournois</a></li>

                    @if (Auth::check())
                        @if (Auth::user()->role->slug == 'ADMIN')
                            <li class="@if (Route::is('sports.index')) active @endif"><a
                                    href="{{ route('sports.index') }}"> <i class="fa fa-futbol"
                                        aria-hidden="true"></i> Sports</a></li>
                            <li class="@if (Route::is('courts.index')) active @endif"><a
                                    href="{{ route('courts.index') }}"> <i class="fa fa-map-marker"
                                        aria-hidden="true"></i> Terrains</a></li>
                            <li class="@if (Route::is('users.index')) active @endif"><a
                                    href="{{ route('users.index') }}"> <i class="fa fa-user-edit"
                                        aria-hidden="true"></i> Personnes</a></li>

                            <li class="@if (Route::is('classes.index')) active @endif"><a
                                    href="{{ route('classes.index') }}"> <i class="fa fa-home"
                                        aria-hidden="true"></i> Classes</a></li>
                        @endif

                        @if (Auth::user()->role == 'participant')
                            <li class="@if (Route::is('profile.index')) active @endif"><a
                                    href="{{ route('profile.index') }}"> <i class="fa fa-user"
                                        aria-hidden="true"></i> Profile</a></li>
                        @endif
                        <li><a href="{{ route('logout') }}"> <i class="fa fa-user" aria-hidden="true"></i> Logout
                                - {{ Auth::user()->username }}</a></li>
                    @elseif(!Auth::check())
                        <li><a href="{{ route('login') }}"> <i class="fa fa-user" aria-hidden="true"></i>
                                Login</a></li>
                    @endif
                </ul>

                <div class="navbar-bottom">
                    @if (Session::get('isDev'))
                        <div class="devLogin"><strong style="color:red;">Logged as Developper</strong></div>
                    @endif
                    <div class="versiontag"><strong style="color:red;">Work in progress</strong></div>
                    <div class="versiontag">v{{ config('app.version') }}</div>
                    <div class="copyright">© CPNV - {{ date('Y') }}</div>
                </div>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5 ml-l-5 ml-md-5 ml-sm-5">
            @include('flash-message')

            @yield('content')
        </div>
    </div>
    <script src="{{ asset('/lib/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/time.js') }}"></script>
    @stack('carousel')
    <script src="{{ asset('/js/carousel.js') }}"></script>
    @yield('customScript')
</body>

<script>
    $(window).on('load', function() {
        $("body").removeClass("preload");
    });
</script>

</html>
