@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
            @isset($gamesession->timeslot->convention)

            @php
                $convention = $gamesession->timeslot->convention
            @endphp
                @include('calendar.conventions.conventionheader')
            
            @endisset

         <div style='font-size: 1.2em;'>
        @foreach($gamesession->timeslot->convention->timeslots as $ts)
            
            @if($ts->id == $gamesession->timeslot->id)
            <div style='font-size: 1.3em; display: inline;'>
                    <a href="/calendar/convention/timeslot/{{$ts->id}}">{{$ts->title}}</a>
            </div>
                
            @else
                <a href="/calendar/convention/timeslot/{{$ts->id}}">{{$ts->title}}</a>
            @endif

            @if( ! $loop->last)
                |
            @endif
        @endforeach
        </div>
        <h4><small>
            {{$gamesession->timeslot->start_time()->format('l')}}  
            {{ 
                $gamesession->timeslot->start_time()->minute == 0 ? 
                $gamesession->timeslot->start_time()->format('ga') : 
                $gamesession->timeslot->start_time()->format('g:ia')
            }}
            to
            {{ 
                $gamesession->timeslot->end_time()->minute == 0 ? 
                $gamesession->timeslot->end_time()->format('ga') : 
                $gamesession->timeslot->end_time()->format('g:ia')
            }}
        </small></h4>
        <hr>
        <div class="mb-4">
            <h4>{{$gamesession->game->title}}</h4>
            <h4 class='mb-4'><small>{{$gamesession->game->tagline}}</small></h4>
            <p class="lead">{{$gamesession->game->lead}}</p>
            <p>{{$gamesession->game->description}}</p>
        </div>
        <div class="row mb-4">
            <div class="col text-center">
                <a href="/profile/show/{{$gamesession->game->user->id}}"> {{$gamesession->game->user->username}}</a>
            </div>
            <div class="col text-center">
                {{$gamesession->game->min}} to {{$gamesession->game->max}} players
            </div>
            <div class="col text-center">
                    {{$gamesession->game->advisory}}
            </div>
            <div class="col"></div>
        </div>

        @if($gamesession->game->timeslots->count() > 1)
            <div class="card">
                <div class="card-header">
                    Other Times
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($gamesession->game->timeslots as $timeslot)
                            @if($timeslot->id != $gamesession->timeslot->id)
                                <a href="/calendar/convention/gamesession/{{ $gamesession->game->getGamesSession($gamesession->game->id, $timeslot->id)->id}}" 
                                class="list-group-item list-group-item-action">
                                    <strong>{{$timeslot->title}}</strong>
                                     - {{$timeslot->start_time()->format('l')}}  
                                    {{ 
                                        $timeslot->start_time()->minute == 0 ? 
                                        $timeslot->start_time()->format('ga') : 
                                        $timeslot->start_time()->format('g:ia')
                                    }}
                                    to
                                    {{ 
                                        $timeslot->end_time()->minute == 0 ? 
                                        $timeslot->end_time()->format('ga') : 
                                        $timeslot->timeslot->end_time()->format('g:ia')
                                    }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if($gamesession->attendees()->count())
        <hr>
        <h5>Attendees</h5>
            @foreach($gamesession->attendees as $attendee)
                <li>{{$attendee->username}}</li>
            @endforeach
        @endif



    </div>
</div>

@endsection