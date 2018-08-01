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

        <ul class="nav nav-tabs" id="timeslotTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="/calendar/convention/timeslot/{{$gamesession->timeslot->id}}">
                    {{$gamesession->timeslot->title}}</a> 
            </li>
        </ul>

        <div class="card">
            <div class="card-header">
                {{$gamesession->timeslot->pretty_times()}}
            </div>
            <div class="card-body">
                <h4>{{$gamesession->game->title}}</h4>
                <h5><small>{{$gamesession->game->tagline}}</small></h5>
                <p class="lead">{{$gamesession->game->lead}}</p>
                <p>{{$gamesession->game->description}}</p>
            </div>
            <div class="card-footer">
                <div class="row mb-4">
                    <div class="col text-center">
                        <strong>Gamemaster:</strong> 
                            <a href="/profile/show/{{$gamesession->game->user->id}}"> {{$gamesession->game->user->username}}</a>
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

        @if($gamesession->game->timeslots->count() > 1)
            <div class="card mt-4">
                <div class="card-header">
                    Other Game Times
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($gamesession->game->timeslots as $timeslot)
                            @if($timeslot->id != $gamesession->timeslot->id)
                                <a href="/calendar/convention/timeslot/game/{{ $gamesession->game->getGamesSession($gamesession->game->id, $timeslot->id)->id}}" 
                                class="list-group-item list-group-item-action">
                                    <strong>{{$timeslot->title}}</strong>
                                     - {{$timeslot->pretty_times()}}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        
    </div>
</div>


        

        @if($gamesession->attendees()->count())
        <hr>
        <h5>Attendees</h5>
            @foreach($gamesession->attendees as $attendee)
                <li>{{$attendee->username}}</li>
            @endforeach
        @endif


@endsection