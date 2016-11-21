<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
      @hasSection('title')@yield('title') - @endif{{ config('app.name', 'Laravel') }}
    </title>

    <link href="/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" />
    @yield('styles')

    <script>
        window.Laravel = {!!json_encode(['csrfToken' => csrf_token()])!!}
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
                    <input type="search" placeholder="Search..." onsearch="search()" />
                  </li>
                  @if (!Auth::guest())
                    <li class="separator"></li>
                    @if (Auth::user()->administrator)
                        <li>
                            <a href="{{ url('/admin') }}">
                                Administrator Area
                            </a>
                        </li>
                        <li class="separator"></li>
                    @endif
                    <li><a href="{{ url('/courses/subscriptions') }}">Course Subscriptions</a></li>
                    <li><a href="{{ url('/videos/favourites') }}">Favourites</a></li>
                    <li><a href="{{ url('/my/videos') }}">My Videos</a></li>
                    <li class="separator"></li>
                    <li><a href="{{ url('/my/videos/new') }}">Add a Video</a></li>
                  @endif
                  <li class="separator"></li>
                  <li><a href="{{ url('/courses') }}">All Courses</a></li>
                  <li><a href="{{ url('/modules') }}">All Modules</a></li>
                  <li class="separator"></li>
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
        @hasSection('adminactions')
          @if(!Auth::guest() and Auth::user()->administrator)
            <div class="row admin toolbar">
              <div class="btn-group pull-right">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  @yield('adminactions')
                </ul>
              </div>
            </div>
          @endif
        @endif
        @hasSection('useractions')
          @if(!Auth::guest() and !Auth::user()->administrator)
            <div class="row admin toolbar">
              <div class="btn-group pull-right">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="glyphicon glyphicon-cog"></i><span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  @yield('useractions')
                </ul>
              </div>
            </div>
          @endif
        @endif
        @yield('content')
    </div>
    <script src="/js/app.js"></script>
    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script>
      function search(){
        let scope = @hasSection('searchscope')"@yield('searchscope')"@else""@endif;
        if (scope.length > 0) scope = "?scope="+encodeURIComponent(scope);
        window.location.href = "{{url('/search')}}/"+$('input[type="search"]').val()+scope;
      }

      (function(){
        $(window).on('load', function(){
          $('.gallery:not(.grid)').mCustomScrollbar({
            axis:'x',
            theme: 'light-thick'
          });
        });
      })(jQuery);
    </script>
</body>
</html>
