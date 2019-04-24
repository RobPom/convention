<nav class="navbar navbar-expand-md navbar-dark  bg-dark ">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Intrigue<span style='color: yellow;'>Con</span>
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
                        <a class="dropdown-item" href="/posts">Latest</a>
                   
                        @auth
                            @if(Auth::user()->hasAnyRole(['organizer' , 'admin']))
                            <a class="dropdown-item" href="/posts/new">New Post</a>
                            @endif
                        @endauth
                    </div>
                </li>
                @if ( App\Convention::where('status' , 'active')->count() )
                    <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Conventions <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                        
                                <a class="dropdown-item" href="/calendar/convention">
                                    {{ App\Convention::where('status' , 'active')->first()->title }} 
                                </a>

                            <!--  <div class="dropdown-divider"></div>    -->
                                <!-- <a class="dropdown-item" href="/calendar/conventions">Past Conventions</a> -->
                    
                        </div>
                    </li>
                @endif

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
               
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                    
                @else
                    <li class="nav-item dropdown  ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle  " href="#" role="button" 
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                            @if(Auth::user()->avatar == 'default.jpg')
                                <img class="img-fluid align-self-center mr-2 mb-1" 
                                    style="height:25px ; max-width: 25px; border-radius: 50%;"
                                    src='/img/avatar/default.jpg'
                                    alt="Avatar Placeholder">
                            @else
                                <img class="img-fluid align-self-center mr-2 mb-1" 
                                    style="height:25px ; max-width: 25px; border-radius: 50%;"
                                    src="/storage/uploads/avatars/{{Auth::user()->avatar}}"
                                    alt="Avatar Placeholder">
                            @endif
                            
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile">Profile</a>
                            
                            @if ( App\Convention::where('status' , 'active')->count() )
                                @if ( App\Convention::where('status' , 'active')->first()->attendees->contains( Auth::user() ) )
                                <a class="dropdown-item" href="/calendar/convention/{{App\Convention::where('status' , 'active')->first()->id}}/attendee/schedule">
                                    <small class="text-muted"> {{ App\Convention::where('status' , 'active')->first()->title }} </small>
                                    <br>My Schedule</a>
                                
                                    <div class="dropdown-divider"></div>   
                                @endif
                            @endif

                           


                            @if ( Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin') )
                                @if ( App\Convention::where('status' , 'active')->count() )
                                
                                <a class="dropdown-item" href="/calendar/convention/{{App\Convention::where('status' , 'active')->first()->id}}/manage">
                                    <small class="text-muted">Organizer Tools</small> <br>
                                    Manage Con
                                </a>
                                <div class="dropdown-divider"></div>
                                @endif
                            @endif

                            @if ( Auth::user()->hasRole('admin') )
                                <a class="dropdown-item" href="/admin">Admin </a>
                                <div class="dropdown-divider"></div>
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