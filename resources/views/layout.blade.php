<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Joutes</title>

        <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/font-awesome/fonts/fontawesome-webfont.woff') }}"  />
        <link href="{{ asset('/font-awesome/fonts/fontawesome-webfont.woff2') }}" />
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/mdb.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/main.css') }}" rel="stylesheet" type="text/css" />

    </head>













    <!--Double navigation-->
    <header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed">
          <ul class="custom-scrollbar">
            <!-- Logo -->
            <li>
              <div class="logo-wrapper waves-light">
                <a href="#"><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" class="img-fluid flex-center"></a>
              </div>
            </li>
            <!--/. Logo -->
            <!--Social-->
            <li>
              <ul class="social">
                <li><a href="#" class="icons-sm fb-ic"><i class="fab fa-facebook-f"> </i></a></li>
                <li><a href="#" class="icons-sm pin-ic"><i class="fab fa-pinterest"> </i></a></li>
                <li><a href="#" class="icons-sm gplus-ic"><i class="fab fa-google-plus-g"> </i></a></li>
                <li><a href="#" class="icons-sm tw-ic"><i class="fab fa-twitter"> </i></a></li>
              </ul>
            </li>
            <!--/Social-->
            <!--Search Form-->
            <li>
              <form class="search-form" role="search">
                <div class="form-group md-form mt-0 pt-1 waves-light">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
              </form>
            </li>
            <!--/.Search Form-->
            <!-- Side navigation links -->
            <li>
              <ul class="collapsible collapsible-accordion">
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-chevron-right"></i> Submit blog<i
                      class="fas fa-angle-down rotate-icon"></i></a>
                  <div class="collapsible-body">
                    <ul class="list-unstyled">
                      <li><a href="#" class="waves-effect">Submit listing</a>
                      </li>
                      <li><a href="#" class="waves-effect">Registration form</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-hand-pointer"></i> Instruction<i
                      class="fas fa-angle-down rotate-icon"></i></a>
                  <div class="collapsible-body">
                    <ul class="list-unstyled">
                      <li><a href="#" class="waves-effect">For bloggers</a>
                      </li>
                      <li><a href="#" class="waves-effect">For authors</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-eye"></i> About<i class="fas fa-angle-down rotate-icon"></i></a>
                  <div class="collapsible-body">
                    <ul class="list-unstyled">
                      <li><a href="#" class="waves-effect">Introduction</a>
                      </li>
                      <li><a href="#" class="waves-effect">Monthly meetings</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="far fa-envelope"></i> Contact me<i class="fas fa-angle-down rotate-icon"></i></a>
                  <div class="collapsible-body">
                    <ul class="list-unstyled">
                      <li><a href="#" class="waves-effect">FAQ</a>
                      </li>
                      <li><a href="#" class="waves-effect">Write a message</a>
                      </li>
                      <li><a href="#" class="waves-effect">FAQ</a>
                      </li>
                      <li><a href="#" class="waves-effect">Write a message</a>
                      </li>
                      <li><a href="#" class="waves-effect">FAQ</a>
                      </li>
                      <li><a href="#" class="waves-effect">Write a message</a>
                      </li>
                      <li><a href="#" class="waves-effect">FAQ</a>
                      </li>
                      <li><a href="#" class="waves-effect">Write a message</a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </li>
            <!--/. Side navigation links -->
          </ul>
          <div class="sidenav-bg mask-strong"></div>
        </div>
        <!--/. Sidebar navigation -->
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
          <!-- SideNav slide-out button -->
          <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fas fa-bars"></i></a>
          </div>
          <!-- Breadcrumb-->
          <div class="breadcrumb-dn mr-auto">
            <p>Material Design for Bootstrap</p>
          </div>
          <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <li class="nav-item">
              <a class="nav-link"><i class="fas fa-envelope"></i> <span class="clearfix d-none d-sm-inline-block">Contact</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link"><i class="fas fa-comments"></i> <span class="clearfix d-none d-sm-inline-block">Support</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link"><i class="fas fa-user"></i> <span class="clearfix d-none d-sm-inline-block">Account</span></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- /.Navbar -->
      </header>
      <!--/.Double navigation-->



































    <body>

        <div class="navbar-header">
            <div class="user-infos">
                @if(Auth::check())
                    <span class="username">{{ Auth::user()->username }}</span>

                @else
                    <span id="login_link" title="Connexion pour les gestionnaires"><i class="fa fa-sign-in" aria-hidden="true"></i> Gestionnaire</span>
                    &nbsp;&nbsp;
                    <span><b><a href="/saml2/login" title="Connexion pour les participants"><i class="fa fa-sign-in" aria-hidden="true"></i> Participant</a></b></span>
                @endif
            </div>
        </div>
        <nav class="navbar">
            <div class="navbar-right">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('events.index') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="">
                </a>
            </div>
            <ul class="nav navbar-nav">
                <li class="@if(Route::is('events.index')) active @endif"><a href="{{ route('events.index') }}"> <i class="fa fa-calendar" aria-hidden="true"></i> Evénements</a></li>
                <li class="@if(Route::is('tournaments.index')) active @endif"><a href="{{ route('tournaments.index') }}"> <i class="fa fa-trophy" aria-hidden="true"></i> Tournois</a></li>
                @if(Auth::check())
                    @if(Auth::user()->role->slug =='ADMIN')
                        <li class="@if(Route::is('sports.index')) active @endif"><a href="{{ route('sports.index') }}"> <i class="fa fa-futbol-o" aria-hidden="true"></i> Sports</a></li>
                        <li class="@if(Route::is('courts.index')) active @endif"><a href="{{ route('courts.index') }}"> <i class="fa fa-map-marker" aria-hidden="true"></i> Terrains</a></li>
                        <li class="@if(Route::is('teams.index')) active @endif"><a href="{{ route('teams.index') }}"> <i class="fa fa-users" aria-hidden="true"></i> Equipes</a></li>
                        <li class="@if(Route::is('participants.index')) active @endif"><a href="{{ route('participants.index') }}"> <i class="fa fa-user" aria-hidden="true"></i> Participants</a></li>

                        <!-- Administation Button -->
                        <li class="@if(Route::is('administration.index')) active @endif"><a href="{{ route('administration.index') }}" class="btn-administration-a"> <input type="button" class="btn btn-administration" value="Administration"></a></li>

                    @endif
                    @if(Auth::user()->role == 'participant')
                        <li class="@if(Route::is('profile.index')) active @endif"><a href="{{ route('profile.index') }}"> <i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                    @endif
                @endif
            </ul>
            <div class="nav navbar-nav navbar-bottom">

                <footer class="footer">
                    <div class="versiontag"><strong style="color:red;">Work in progress</strong></div>
                    <div class="versiontag"></div>
                    <div class="copyright">© CPNV - 2019</div>
                    <div class="devs">
                        <a href="#" class="show-devs">Développeurs</a>

                        <div class="dev-names hide">
                            <a href="#" class="dev">Davide Carboni</a>
                            <a href="#" class="dev">Doran Kayoumi</a>
                            <a href="#" class="dev">Loïc Dessaules</a>
                            <a href="#" class="dev">Antoine Dessauges</a>
                            <a href="#" class="dev">Jérémy Gfeller</a>
                            <a href="#" class="dev">Senistan Jegarajasingam</a>
                            <a href="#" class="dev">Quentin Rossier</a>
                        </div>

                    </div>
                </footer>
            </div>

        </nav>

        <div id="page">

            <div id="content">

                @yield('content')

            </div><!-- content -->

        </div><!-- page -->

        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="{{ asset('/js/mdbootstrap/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/mdbootstrap/bootstrap.min.js') }}"></script>

    </body>
</html>
