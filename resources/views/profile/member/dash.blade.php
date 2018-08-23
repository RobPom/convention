@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h3>
            @if($member->hasRole('organizer'))
                {{$member->firstname}} {{$member->lastname}}
            @else
                {{$member->username}}
            @endif
        </h3>

        <small>member since {{ (new \Carbon\Carbon($member->created_at))->toFormattedDateString() }} </small>
        <br>
        <hr>
        <ul class="nav nav-tabs" id="dashboard-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ ! count($_GET) ? 'active' : '' }}" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true">Profile</a>
            </li>
            @if($member->blogPosts()->whereNotNull('posted_on')->get()->count())
            <li class="nav-item">
                <a class="nav-link {{ Request::get('tab') == 'posts'? 'active' : '' }}" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>
            </li>
            @endif

            <!-- a member's saved games, only the owner can see it  -->
            @auth
                @if($member == Auth::user()
                    || $member->games()->where('active' , true)->first()
                    || $member->games()->whereHas('timeslots')->get()->count())
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('tab') == 'games'? 'active' : '' }}" id="games-tab" data-toggle="tab" href="#games" role="tab" aria-controls="games" aria-selected="false">Games</a>
                    </li>
                @endif
            @endauth

            <!-- a member's active or scheduled games: anyone can see -->
            @guest
                @if($member->games()->where('active' , true)->first()
                    || $member->games()->whereHas('timeslots')->get()->count())
                    <li class="nav-item">
                        <a class="nav-link {{ Request::get('tab') == 'games'? 'active' : '' }}" id="games-tab" 
                        data-toggle="tab" href="#games" role="tab" aria-controls="games" aria-selected="false">Games</a> 
                    </li>
                @endif
            @endguest

            @auth
                @if( App\Convention::where('status' , 'active')->first() )
                    @if( App\Convention::where('status' , 'active')->first()->attendees()->where('user_id', $member->id)->exists() )
                        @if(Auth::user() == $member || $user->hasRole('organizer') || $user->hasRole('admin'))
                            <li class="nav-item">
                                <a class="nav-link {{ Request::get('tab') == 'schedule'? 'active' : '' }}" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab" aria-controls="calendar" aria-selected="false">Convention Schedule</a>
                            </li>
                        @endif
                    @endif
                @endif
            @endauth
        </ul>

        <div class="tab-content" id="dashboardTabContent">
            <div class="tab-pane fade {{ ! count($_GET) ? 'active show' : '' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <small>{{$member->username}}'s</small><br>
                                <strong>Community Profile</strong>
                            </div>
                            <div class="col text-right">
                                @auth
                                    @if( $user->id == $member->id ||$user->hasRole('organizer') ||  $user->hasRole('admin') )
                                        <a href="/profile/{{$user->id}}/edit" class="mt-2 btn btn-sm btn-secondary">Edit</a>
                                    @endif
                                @endauth
                            </div>
                        </div>       
                    </div>
                    <div class="card-body">
                        <p>
                            @auth
                            <strong>email: </strong>{{$member->email}} <br>
                            @endauth
                            <strong>about: </strong>{{$member->profile->description}} 
                        </p>
                        @auth
                            @if( $user->id == $member->id ||$user->hasRole('organizer') ||  $user->hasRole('admin') )
                                <p>
                                    <h6> <strong> Private Info</strong></h6>
                                    <strong>Full Name:</strong> {{$member->firstname}} {{$member->lastname}}<br>
                                    <strong>Location: </strong> {{$member->profile->location}}
                                </p>
                            @endif
                        @endauth
                    </div>   
                </div> 
            </div>

            @if($member->blogPosts()->whereNotNull('posted_on')->count())
                <div class="tab-pane fade {{ Request::get('tab') == 'posts'? 'active show' : '' }}" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <small>{{$member->username}}'s</small><br>
                                    <strong>Latest Posts</strong>
                                </div>
                                <div class="col text-right">
                                    @auth
                                        @if($member->hasAnyRole(['organizer' , 'admin']))
                                            <a href="/posts/new" class="mt-2 btn btn-sm btn-secondary">New</a>
                                        @endif
                                    @endauth
                                </div>
                            </div>    
                        </div>
                        <div class="card-body">
                            @auth
                                @if ($user->id == $member->id)
                                    @include('layouts.include.post-list', array('showUnpublished' => true, 'edit' => true,  'posts' => $member->blogPosts, 'archive' => true))
                                @else
                                    @include('layouts.include.post-list', array('showUnpublished' => false, 'edit' => false,'posts' => $member->blogPosts, 'archive' => true))
                                @endif
                            @else
                                @include('layouts.include.post-list', array('showUnpublished' => false, 'edit' => false,'posts' => $member->blogPosts, 'archive' => true))
                            @endauth

                        </div>
                    </div>
                </div>
            @endif
            

             <!-- a member's saved games, only the owner can see it  -->
            <div class="tab-pane fade {{ Request::get('tab') == 'games' ? 'active show' : '' }}" id="games" role="tabpanel" aria-labelledby="games-tab"> 
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <small>{{$member->username}}'s</small><br>
                                <strong>Games</strong>
                            </div>
                            <div class="col text-right">
                                @auth
                                    @if($member->id == Auth::user()->id)
                                        <a href="/games/new" class="mt-2 btn btn-sm btn-secondary">New</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if( $member->games->where('active' , true )->first() )
                            <div class="card my-2 border-0">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        
                                        @foreach($member->games as $game)
                                            @if($game->active)
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a href="/profile/game/{{$game->id}}"> {{$game->title}}</a> <br>
                                                            <small>{{$game->tagline}}</small>
                                                        </div>
                                                        <div class="col-md-6">
                                                            @auth
                                                                @if($member->id == Auth::user()->id || Auth::user()->hasRole('organizer'))
                                                                    <form class='form-inline float-right'
                                                                        onsubmit="return confirm('You cannot undo this. Are you sure you want to delete this game?');"
                                                                        action="{{action('GameController@destroy', $game->id)}}" 
                                                                        method="post">
        
                                                                            @csrf
                                                                            @method('DELETE')
        
                                                                            <a href="/profile/game/{{$game->id}}/edit" class="m-1 btn btn-sm btn-primary">Edit</a>
                                                                            @if($member->id == Auth::user()->id)
                                                                                <button class="m-1 btn btn-sm btn-danger" type="submit">Delete</button>
                                                                            @endif
                                                                    </form>
                                                                @endif
                                                            @endauth
                                                        </div>
                                                    </div>
                                                </li> 
                                            @endif
                                        @endforeach  
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif  

                        @if( $member->games->where('active' , false )->first() )
                            @auth
                                @if($member->id == Auth::user()->id)
                                <div class="card my-2 border-0">
                                        <div class="card-body">
                                            <h5>Drafts</h5>
                                            <ul class="list-group list-group-flush">
                                                
                                                @foreach($member->games as $game)
                                                    @if( ! $game->active)
                                                        <li class="list-group-item">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <a href="/profile/game/{{$game->id}}"> {{$game->title}}</a> <br>
                                                                    <small>{{$game->tagline}}</small>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    @auth
                                                                        @if($member->id == Auth::user()->id || Auth::user()->hasRole('organizer'))
                                                                            <form class='form-inline float-right'
                                                                                onsubmit="return confirm('You cannot undo this. Are you sure you want to delete this game?');"
                                                                                action="{{action('GameController@destroy', $game->id)}}" 
                                                                                method="post">
                
                                                                                    @csrf
                                                                                    @method('DELETE')
                
                                                                                    <a href="/profile/game/{{$game->id}}/edit" class="m-1 btn btn-sm btn-primary">Edit</a>
                                                                                    @if($member->id == Auth::user()->id)
                                                                                        <button class="m-1 btn btn-sm btn-danger" type="submit">Delete</button>
                                                                                    @endif
                                                                            </form>
                                                                        @endif
                                                                    @endauth
                                                                </div>
                                                            </div>
                                                        </li> 
                                                    @endif
                                                @endforeach  
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                
                                @endif
                            @endauth 
                        @endif
                            
                        @if(null !== $convention)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-white">
                                        <small>{{$convention->start_date()->format('F jS')}}
                                                to
                                                {{$convention->end_date()->format('jS')}}
                                        </small> <br>
                                        <strong>{{$convention->title}}</strong>
                                    </div> 
                                    <div class="card-body">


                                    @if($convention->games()->where('user_id' , $member->id)->get()->count())
                                       <div class="card border-0">
                                           <div class="card-body">
                                               <div class="card-title">
                                                    Convention Games
                                                </div>
                                               @php $membergames = $convention->games()->where('user_id' , $member->id)->get(); @endphp
                                               
                                                <ul class="list-group list-group-flush">
                                                    @foreach($membergames as $game)
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            @if($game->timeslots()->count() > 0 )
                                                            @php 
                                                                $ts = $game->timeslots()->first();
                                                                $firstsession = $ts->gamesession($game);
                                                            @endphp

                                                                @if( $game->timeslots()->count() > 1)
                                                                    <div class="col-md-6">
                                                                        <a href="/calendar/convention/timeslot/game/{{$firstsession->id}}">
                                                                            {{$game->title}}
                                                                        </a> <br>
                                                                    </div>
                                                                    <div class="col-md-6  text-right">
                                                                        Scheduled {{$game->timeslots()->count()}} times.
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-6">
                                                                        <a href="/calendar/convention/timeslot/game/{{$firstsession->id}}">
                                                                            {{$game->title}}
                                                                        </a> <br>
                                                                    </div>
                                                                    <div class="col-md-6  text-right">
                                                                        <strong>{{$game->timeslots()->first()->title}}</strong> <br>
                                                                        {{$game->timeslots()->first()->pretty_times()}}
                                                                    </div>
                                                                    
                                                                @endif
                                                            @else
                                                                <div class="col-md-6">
                                                                    <a href="/profile/game/{{$game->id}}">
                                                                        {{$game->title}}
                                                                    </a> <br>
                                                                </div>
                                                                <div class="col-md-6  text-right">
                                                                    <strong>TBD</strong>
                                                                </div>
                                                            @endif
                                                        </div> 
                                                    </li> 
                                                    @endforeach
                                                </ul>
                                           </div>
                                       </div>
                                    @endif        
                                    
                                    @Auth
                                    <div class="card border-0">
                                        <div class="card-body">
                                            <div class="card-title">
                                                Submissions
                                            </div>
                                            @if( $convention->submissions()->where('user_id' , $user->id)->get()->count())
                                            <ul class="list-group list-group-flush">
                                                @foreach($convention->submissions()->where('user_id' , $user->id)->get() as $submission)
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a href=""> {{App\Game::find($submission->game_id)->title}}</a>
                                                        </div>
                                                        <div class="col-md-6">

                                                        </div>
                                                    </div>
                                                @endforeach
                                            </ul>
                                            @endif
                                            <div class="row mt-4">
                                                <div class="col text-right">
                                                    <a class="btn btn-sm btn-secondary" href="/calendar/convention/game/submit">Submit a Game</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    @endauth
                                </div>
                            </div>        
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
  
            @auth
                @isset($convention)
                    @php $convention = App\Convention::where('status' , 'active')->first(); @endphp

                    @if( $convention->attendees()->where('user_id', $member->id)->exists() )
                        @if(Auth::user() == $member || $user->hasRole('organizer') || $user->hasRole('admin'))
                            <div class="tab-pane fade {{ Request::get('tab') == 'schedule'? 'active show' : '' }}" id="calendar" role="tabpanel" aria-labelledby="calendar-tab"> 
                                @include('profile.attendee.calendar', ['user' => $member])
                            </div>
                        @endif
                    @endif
                @endisset
            @endauth   
        </div>
    </div>
</div>

@endsection
