@extends('layouts.app')

@section('content')

<div class="card p-2 border-0">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-md-8 text-center text-md-left">
                <h5> <a href="/calendar/convention/{{$convention->id}}">{{$convention->title}}</a> </h5>
            </div>
            <div class="col-md-4 text-center text-md-right">
                <small>{{$convention->pretty_dates()}}</small>
            </div>
        </div>
        <div class="row mt-1">

            <div class="col-md-8 text-center text-md-left">
                <h5><small>{{$convention->tagline}}</small></h5>
            </div>
            
            @auth
                @if( Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')  )
                    @if($convention->status != 'archived')
                        <div class="col-md-4 text-right">
                            <a href="/calendar/convention/{{$convention->id}}/manage" class="btn btn-sm btn-primary">Manage</a>
                        </div>
                    @endif
                @endif
            @endauth

        </div>  
    </div>
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item">
                    <a href="/calendar/convention/{{$convention->id}}">Convention</a>
                </li>
                <li class="breadcrumb-item"><a href="/calendar/convention/{{$convention->id}}/schedule">Schedule</a></li>
                <li class="breadcrumb-item"><a href="/calendar/convention/timeslot/{{$gamesession->timeslot->id}}">Timeslot</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$gamesession->timeslot->title}}</li>
            </ol>
        </nav>
        
        <div class="card">
            <div class="card-header">
               <strong> {{$gamesession->timeslot->start_time()->format('l')}}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 card-title">
                        <div class='lead'>{{$gamesession->timeslot->title}}</div>
                        <small class="text-muted">{{$gamesession->timeslot->only_times()}}</small>
                        <br><br>
                        @auth
                            @if(Auth::user()->hasRole('organizer'))
                            <small class='text-muted'>
                                Players : {{$gamesession->attendees->count()}} <br>
                                GMs : 1 <br>
                                Total: {!! $gamesession->attendees->count() + 1 !!}
                            </small>
                            @endif
                        @endauth
                        
                        @if($gamesession->game->timeslots->count() > 1)
                        <hr class="mx-2">
                            <strong><small>Other Times</small></strong>
                            <ul class="list-group">

                                @foreach($gamesession->game->timeslots as $timeslot)
                                    @if($gamesession->timeslot->id != $timeslot->id)
                                        <a href="/calendar/convention/session/{{ $timeslot->gamesession($gamesession->game)->id}}" 
                                        class="list-group-item list-group-item-action small pl-3 py-2">
                                        
                                            <strong>{{$timeslot->title}}</strong>
                                            - {{$timeslot->pretty_times()}}
                                        </a>
                                    @endif
                                @endforeach
                               
                                
                            </ul>
                        @endif
                            
                  
                    </div>
                    <div class="col-md-9">
                            <h4 class=" mb-3">{{$gamesession->game->title}}</h4>
                        <div class="row">
                            
                            <div class="col-md-4 d-none d-md-block text-center">
                                @if($gamesession->game->image == 'default.jpg')
                                    <img class="img-responsive" 
                                        style="max-width: 180px;"
                                        src='/img/game_images/default.jpg'
                                        alt="Avatar Placeholder">
                                @else
                                    <img class=img-responsive" 
                                    style="max-width: 180px;"
                                        src="/storage/uploads/game_images/{{$gamesession->game->image}}"
                                        alt="Avatar Placeholder">
                                @endif

                            </div>
                            <div class="col-sm-12 col-md-8">
                                
                                <h5><small>{{$gamesession->game->tagline}}</small></h5>
                                <p class="lead">{{$gamesession->game->lead}}</p>
                                <p>{!! $gamesession->game->description !!}</p>

                            </div>
                        </div>
                            
                    </div> 
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="row mb-1">
                    <div class="col text-center">
                        <strong>Gamemaster:</strong> 
                            <a href="/profile/show/{{$gamesession->game->user->id}}?tab=games"> {{$gamesession->game->user->username}}</a>
                    </div>

                    <div class="col text-center">
                        {{$gamesession->game->min}} to {{$gamesession->game->max}} players
                    </div>
                    @isset($gamesession->game->advisory)
                        <div class="col text-center">
                            {{$gamesession->game->advisory}}
                        </div>
                    @endisset
                    @isset($gamesession->game->system)
                        <div class="col text-center">
                            {{$gamesession->game->system}}
                        </div>
                    @endisset
                </div>
                </div>
            </div>
        </div>

        
    @auth
    @if( $convention->hasAttendee(Auth::user()->id) || Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin') )
        
            <div class="card mt-4">
                <div class="card-header">
                    Attendance
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>{{$gamesession->attendees->count()}}  Attendees</strong> <br>
                            @foreach($gamesession->attendees as $attendee)
                                <a href="/profile/show/{{$attendee->id}}">
                                    @if($attendee->id == Auth::user()->id)
                                        You
                                    @else
                                        {{$attendee->username}} 
                                    @endif
                                    @if( ! $loop->last ) , @endif
                            </a>
                        @endforeach
                        </div>

                        <div class="col-md-8 mt-2">
                            <strong>Game Selection</strong> <a href="/calendar/convention/{{$convention->id}}/attendee/schedule"> <em> <small> Your Schedule </small></em></a> <br>

                            @if($gamesession->timeslot->games->where('user_id' , Auth::user()->id)->count())
                                @php 
                                    $game = $gamesession->timeslot->games->where('user_id' , Auth::user()->id)->first();
                                @endphp
                                @if($gamesession->game->user->id == Auth::user()->id)
                                    You are the GM of this Game
                                @else
                                    <small>You are scheduled to GM </small> 
                                    <a href="/calendar/convention/session/{{$gamesession->timeslot->gamesession($game)->id}}"> <strong class='ml-1 '> {{$gamesession->timeslot->games->where('user_id', Auth::user()->id )->first()->title}}</strong></a>
                                @endif
                            @else

                                @if(Auth::user()->gamesessions->where('timeslot_id' , $gamesession->timeslot->id)->first())
                                    <div class="row">

                                        @if(Auth::user()->gamesessions->where('timeslot_id' , $gamesession->timeslot->id)->first()->game->id == $gamesession->game->id)
                                            <div class="col-sm-8">  
                                                You are scheduled to play. 
                                            </div>
                                            <div class="col-sm-4">
                                                <form 
                                                    action="{{ action('Calendar\GameSessionController@leave' , $gamesession) }}" 
                                                    method="post">
                                                    @csrf
                                                    <button class="m-1 btn btn-sm btn-danger btn-block" type="submit">Leave</button>
                                                </form> 
                                            </div>

                                        @else
                                            <div class="col-sm-8">
                                                <small>You are scheduled to play</small> <br>
                                                <a href="/calendar/convention/session/{{Auth::user()->gamesessions->where('timeslot_id' , $gamesession->timeslot->id)->first()->id}}">
                                                    {{Auth::user()->gamesessions->where('timeslot_id' , $gamesession->timeslot->id)->first()->game->title}}
                                                </a>
                                            </div>
                                            <div class="col-sm-4">
                                                <form 
                                                    action="{{ action('Calendar\GameSessionController@replace' , $gamesession) }}" 
                                                    method="post">
                                                    @csrf
                                                    <button class="m-1 btn btn-sm btn-primary btn-block" type="submit">Play This Instead</button>
                                                </form> 
                                            </div>
                                        @endif

                                    </div> 
                                @else

                                    @if( $gamesession->attendees->count() >= $gamesession->game->max)
                                        <div class="row">
                                            <div class="col-sm-8">
                                                This game is full.
                                            </div>
                                            <div class="col-sm-4">
                                                
                                            </div>
                                        </div> 
                                    @else
                                    <div class="row">
                                        <div class="col-sm-8">
                                           This timeslot is empty.
                                        </div>
                                        <div class="col-sm-4">
                                            <form 
                                                action="{{ action('Calendar\GameSessionController@attend' , $gamesession) }}" 
                                                method="post">
                                                @csrf
                                                <button class="m-1 btn btn-sm btn-primary btn-block" type="submit">Play!</button>
                                            </form> 
                                        </div>
                                    </div> 
                                    @endif
                                    
                                @endif
                            @endif
                        </div>
                    </div>
                   
                </div>
            </div>
            <h5></h5>
                
        
    @endif
@endauth
</div>
</div>

        


@endsection