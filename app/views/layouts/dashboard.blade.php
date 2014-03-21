<!DOCTYPE html>
<html lang="en" class="app">
<head>
  <meta charset="utf-8" />
  <title>Dashboard | Human Capital</title>
  <meta name="description" content="IDMS | Information and Data Management System" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/font.css') }}" type="text/css" />
  @yield('pagecss')
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" cache="false"/>
  <!--[if lt IE 9]>
    <script src="{{ asset('js/ie/html5shiv.js') }}" cache="false"></script>
    <script src="{{ asset('js/ie/respond.min.js') }}" cache="false"></script>
    <script src="{{ asset('js/ie/excanvas.js') }}" cache="false"></script>
  <![endif]-->

</head>
<body>
  {{-- Loading animation --}}
  <div class="loading"></div>

  <section class="vbox">
    {{-- BEGIN Header --}}
    <header class="bg-dark dk header navbar navbar-fixed-top-xs">
      {{-- BEGIN Brand and toggle get grouped for better mobile display (centered) --}}
      <div class="navbar-header aside-md">
        {{-- Toggle button, only show on mobile --}}
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        {{-- Logo --}}
    <a href="#" class="navbar-brand" data-toggle="fullscreen"><img src="{{ asset('images/logo.png') }}" class="m-r-sm">Human Capital</a>
        {{-- Profile, only show on mobile --}}
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      {{-- END Brand and toggle --}}

      {{-- BEGIN Notification and Profile, grouped --}}
      <ul class="nav navbar-nav navbar-right hidden-xs nav-user">

        {{-- Profile --}}
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{-- Profile Picture --}}
            <span class="thumb-sm avatar pull-left">
              <img src="{{ asset('images/avatar_default.jpg')}}"> {{-- default pict if no picture --}}
            </span>
            Syarif
            <b class="caret"></b>
          </a>
          {{-- BEGIN Profile Menu --}}
          <ul class="dropdown-menu animated fadeInRight">
            {{-- arrow top above menu--}}
            <span class="arrow top"></span>
            {{-- Menu Item--}}
            <li>
                <a href="#">Update Profile</a>
            </li>
            <li>
              <a href="#">Change Password</a>
            </li>
            {{-- Divider line --}}
            <li class="divider"></li>
            <li>
              <a href="{{ URL::to('logout') }}">Logout</a>
            </li>
          </ul>
        </li>
        {{-- END Profile Menu --}}
      </ul>
      {{-- END Notification and Profile --}}

    </header>
    {{-- END Header --}}

    {{-- BEGIN content section (sidebar nav + content) --}}
    <section>
      {{-- BEGIN hbox (horizontal container). Contain: aside, content, aside --}}
      <section class="hbox stretch">

        {{-- BEGIN sidebar nav --}}
    <aside class="bg-dark lter aside-md hidden-print" id="nav">
          {{-- BEGIN vbox inside sidebar nav (to make header,content and footer) --}}
          <section class="vbox">
            {{-- BEGIN slimscroll sidebar nav content : Make sidebar nav scrollable with slimscroll --}}
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-color="#333333">
                {{-- BEGIN sidebar nav container --}}
                <nav class="nav-primary hidden-xs">
                  {{-- BEGIN nav item --}}
                  <ul class="nav">
                    {{ HTML::bt_nav(array(
                        array(
                          'icon' => 'fa fa-group icon',
                          'icon-bg' => 'bg-warning',
                          'title' => 'Job Prefix',
                          'url' => route('jobprefixes.index')
                        ),
                        array(
                          'icon' => 'fa fa-group icon',
                          'icon-bg' => 'bg-warning',
                          'title' => 'Functional Scopes',
                          'url' => route('functionalscopes.index')
                        ),
                        array(
                          'icon' => 'fa fa-group icon',
                          'icon-bg' => 'bg-warning',
                          'title' => 'Job Titles',
                          'url' => route('jobtitles.index')
                        ),

                      )) }}
                  </ul>
                  {{-- END nav item --}}
                </nav>
                {{-- END sidebar nav container --}}
              </div>
            </section>
            {{-- END slimscroll sidebar nav content --}}

            {{-- BEGIN sidebar nav footer --}}
        <footer class="footer lt hidden-xs b-t b-dark">
              {{-- Toogle sidebar nav to small --}}
          <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
            </footer>
            {{-- END siebar nav footer --}}

          </section>
          {{-- END vbox inside sidebar nav --}}
        </aside>
        {{-- END sidebar nav --}}

        {{-- BEGIN content --}}
        <section id="content">
          {{-- BEGIN vbox content --}}
          <section class="vbox">
            {{-- BEGIN content scrollable --}}
            <section class="scrollable padder">
              {{-- BEGIN breadcrumb --}}
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="{{ URL::to("/") }}"><i class="fa fa-home"></i> Home</a></li>
                @yield('breadcrumb')
              </ul>
              {{-- END breadcrumb --}}

              {{-- BEGIN Alert Messages--}}
                @if (Session::has('success-message'))
                  <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <h4><i class="fa fa-info-circle m-r-sm"></i>Hoooray!</h4>
                      <p>{{ Session::get('success-message') }}</p>
                  </div>
                @elseif (Session::has('error-message'))
                  <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <h4><i class="fa fa-warning m-r-sm"></i>Uh, Oh!</h4>
                      Something need to be fixed:
                      <p>{{ Session::get('error-message') }}</p>
                  </div>
                @endif
              {{-- END Alert--}}
              @yield('content')

            </section>
            {{-- END content scrollable --}}
          </section>
          {{-- END vbox content --}}
          {{-- Link to hide off screen nav --}}
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
        {{-- END content --}}
      </section>
      {{-- END hbox --}}
    </section>

    {{-- END content section --}}
  </section>
  {{-- END vbox section --}}
  <!-- jquery -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <!-- App -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/slimscroll/jquery.slimscroll.min.js') }}"></script>
  {{-- placeholder for page's javascript --}}
  @yield('pagejs')

</body>
</html>
