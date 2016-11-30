<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <style type="text/css">

        #coverAll{
            position: fixed; height: 100%; width: 100%; top:0; left: 0; background: #F1F1F1; z-index:9999;
        }

    </style>
    <!-- <link href="/css/app.css" rel="stylesheet"> -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
    
    <!-- <script type="text/javascript" href="/js/bootstrap.min.js"></script> -->
    <script src="/js/jquery-3.1.1.min.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

        $(window).bind("load", function () {
                    $("#coverAll").hide();
              });
    </script>
</head>
<body>
<div id="coverAll"><img src="/images/tits.gif" style="display: block; margin: 0 auto;"></div>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown" style="position: relative; padding-left: 50px;">
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="height:32px; width: 32px; position: absolute; top: 10px; left: 10px; border-radius: 50%;">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/home">
                                            <i class="glyphicon glyphicon-home"></i>&nbsp;Home
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/homeplanet">
                                            <i class="glyphicon glyphicon-globe"></i>&nbsp;Planet
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/orbitalbase">
                                            <i class="glyphicon glyphicon-map-marker"></i>&nbsp;Orbital Base
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/radar">
                                            <i class="glyphicon glyphicon-search"></i>&nbsp;Radar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/profile') }}">
                                            <i class="glyphicon glyphicon-user"></i>&nbsp;Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="glyphicon glyphicon-off"></i>&nbsp;Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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
    </div>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
