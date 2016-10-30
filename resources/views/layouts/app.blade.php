<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="/css" rel="stylesheet">

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                  <li class="search">
                    <input type="text" placeholder="Search..." />
                  </li>
                  @if (!Auth::guest())
                    @if (Auth::user()->administrator)
                        <li>
                            <a href="{{ url('/admin') }}">
                                Administrator Area
                            </a>
                        </li>
                        <li class="separator"></li>
                    @endif
                    <li><a href="{{ url('/my/courses') }}">My Courses</a></li>
                    {{!--<li><a href="{{ url('/my/modules') }}">My Modules</a></li>--}}
                    <li><a href="{{ url('/my/videos') }}">My Videos</a></li>
                    <li><a href="{{ url('/my/favourites') }}">My Favourites</a></li>
                  @endif
                  <li class="separator"></li>
                  <li><a href="{{ url('/courses') }}">All Courses</a></li>
                  <li><a href="{{ url('/modules') }}">All Modules</a></li>
                  <li><a href="{{ url('/videos') }}">All Videos</a></li>

                  @if(Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                  @else
                    <li>
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                  @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
