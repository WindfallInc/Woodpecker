<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jaunt</title>
        <!-- FONTS -->
        <script src="https://use.fontawesome.com/72afff18ae.js"></script>
        <!-- CSS -->
        <link href="/css/woodpecker/admin.css" rel="stylesheet" type="text/css">
        <!-- SCRIPTS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        @stack('header')
        <style>
        .btn-primary {
          width: 100%;
          padding: 8px;
          font-size: 1.3em;
          background-color: #9CC054;
          color: #fff;
          text-transform: uppercase;
          transition: linear .2s all;
        }
        .btn-primary:hover{
          background-color:#829B48;
        }
        </style>

    </head>

<body class="admin">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header centering">
              <img src="/css/woodpecker/woodpecker-logo.png" width="300px">
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right" style="position:absolute; right:60px; top:40px;">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/dashboard/login') }}">Login</a></li>
                        <li><a href="{{ url('/dashboard/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/dashboard/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/dashboard/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
