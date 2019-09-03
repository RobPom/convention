@extends('layouts.app')

@section('content')

<div class="card p-2 border-0">
    <div class="card-header bg-white border-0">
            @include('profile.member.header')
    </div>
    <div class="card-body">
        <hr>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item">
                        <a href="/profile/show/{{$member->id}}">Profile</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Games</li>
                </ol>
            </nav>
        <div class="card">
            <div class="card-header">
                <strong>{{$member->username}}'s Games </strong>
            </div>
            <div class="card-body">

        @if( $member->games->where('active' , true )->first() )
            <div class="card border-0">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($member->games->where('active' , true ) as $game)
                            @if($game->event_id == 0)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="/profile/game/{{$game->id}}"> {{$game->title}}</a> <br>
                                            <small>{{$game->tagline}}</small>
                                        </div>
                                        <div class="col-md-6">
                                            @auth
                                                @if($member->id == Auth::user()->id || Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin'))
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
            
        @if(null !== $convention && $convention->attendees->where('id' , $member->id)->count() && $member->games->count())

        @auth
            @if(Auth::user()->id == $member->id)
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


                            @if($convention->games()->where('user_id' , $member->id)->where('event_id' , $convention->id)->get()->count())
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
                                                                    <a href="/calendar/convention/{{$convention->id}}/game/{{$game->id}}">
                                                                    {{$game->title}}
                                                                </a> <br>
                                                            </div>
                                                            <div class="col-md-6  text-right">
                                                                Scheduled {{$game->timeslots()->count()}} times.
                                                            </div>
                                                        @else
                                                            <div class="col-md-6">
                                                                <a href="/calendar/convention/{{$convention->id}}/game/{{$game->id}}">
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
                                        <strong>Gamemasters</strong>
                                        <small>
                                            <p>We are always on the lookout for people who love bringing their stories to players. 
                                                If you are interested in becoming a game master for the upcoming convention, first make sure you create a game, then click the 'Submit a Game' button below.</p>
                                        </small>
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
            @endif
        @endauth


@endsection