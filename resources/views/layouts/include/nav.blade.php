<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'IntrigueCon') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                
               <!--  <li><a class="nav-link" href="">About</a></li> -->

                <li class="nav-item dropdown ">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Blog <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/posts/latest">Lastest</a>
                        <a class="dropdown-item" href="/posts">Archive</a>
                        @auth
                            @if(Auth::user()->hasAnyRole(['organizer' , 'admin']))
                            <a class="dropdown-item" href="/posts/new">New Post</a>
                            @endif
                        @endauth
                    </div>
                </li>
                <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Conventions <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                        @if ( App\Convention::where('status' , 'active')->count() )
                            <a class="dropdown-item" href="/calendar/convention">
                            <small class="text-muted"> Registration Open! </small><br> {{ App\Convention::where('status' , 'active')->first()->title }}</a>
                        @endif
                                <a class="dropdown-item" href="/calendar/conventions">All</a>
                  
                    </div>
                    

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
               
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    
                @else
                    <li class="nav-item dropdown  ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                            
                            @if ( App\Convention::where('status' , 'active')->count() )
                                @if ( App\Convention::where('status' , 'active')->first()->attendees->contains( Auth::user() ) )
                                    <a href="/calendar/convention/sessions/{{Auth::user()->id}}" class="dropdown-item">My Schedule</a>
                                @endif
                            @endif

                            <a class="dropdown-item" href="/profile">Profile</a>

                            @if ( Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin') )
                                @if ( App\Convention::where('status' , 'active')->count() )
                                <a class="dropdown-item" href="/calendar/convention/{{App\Convention::where('status' , 'active')->first()->id}}/manage">
                                    Manage Con
                                </a>
                                @endif
                            @endif

                            @if ( Auth::user()->hasRole('admin') )
                                <a class="dropdown-item" href="/admin">Admin </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>