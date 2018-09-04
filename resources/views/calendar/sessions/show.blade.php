@extends('layouts.app')

@section('content')

<div class="card p-2">
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
                <li class="breadcrumb-item active" aria-current="page">Session</li>
            </ol>
        </nav>
        
        <div class="card">
            <div class="card-header">
               <strong> {{$gamesession->timeslot->start_time()->format('l')}}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 card-title">
                        <div class='lead'>{{$gamesession->timeslot->title}}</div>
                        <small class="text-muted">{{$gamesession->timeslot->only_times()}}</small>
                        <br><br>
                        <small class='text-muted'>
                            Players : ## <br>
                            GMs : {{$gamesession->timeslot->games->count()}}
                        </small>
                        @if($gamesession->game->timeslots->count() > 1)
                        <hr class="mx-2">
                            <strong><small>Other Times</small></strong>
                            <ul class="list-group">

                                @foreach($gamesession->game->timeslots as $timeslot)
                                    @if($timeslot->id != $gamesession->timeslot->id)
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
                    <div class="col-md-8">
                            <h4>{{$gamesession->game->title}}</h4>
                            <h5><small>{{$gamesession->game->tagline}}</small></h5>
                            <p class="lead">{{$gamesession->game->lead}}</p>
                            <p>{!! $gamesession->game->description !!}</p>
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
                </div>
            </div>
        </div>

        
    @auth
    @if( Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin') )
        @if($gamesession->attendees()->count())
            <div class="card mt-4">
                <div class="card-header">
                    Attendees
                </div>
                <div class="card-body">
                    <p>There are {{$gamesession->attendees()->count()}} people signed up for this game. </p>

                    @foreach($gamesession->attendees as $attendee)
                        <li>{{$attendee->username}}</li>
                    @endforeach
                </div>
            </div>
            <h5></h5>
                
        @endif
    @endif
@endauth
</div>
</div>

        


@endsection