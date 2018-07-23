@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <h4>{{$game->title}}</h4>
            <h4 class='mb-4'><small>{{$game->tagline}}</small></h4>
            <p class="lead">{{$game->lead}}</p>
            <p>{{$game->description}}</p>
        </div>
        <div class="row mb-4">
            <div class="col text-center">
                <a href="/profile/show/{{$game->user->id}}"> {{$game->user->username}}</a>
            </div>
            <div class="col text-center">
                {{$game->min}} to {{$game->max}} players
            </div>
            <div class="col text-center">
                    {{$game->advisory}}
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>
@if($game->timeslots->count())
    <div class="card mt-4">
        <div class="card-header">
            Convention Schedule
        </div>
        <div class="card-body">
            <div class="list-group">
                @foreach($game->timeslots as $timeslot)
                        <a href="/calendar/convention/gamesession/{{ $game->getGamesSession($game->id, $timeslot->id)->id}}" 
                        class="list-group-item list-group-item-action">
                            <strong></strong>
                            {{$timeslot->start_time()->format('l')}}  
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
                @endforeach
            </div>
        </div>
    </div>
@endif

@endsection