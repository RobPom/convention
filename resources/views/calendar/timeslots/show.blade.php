@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
            @isset($timeslot->convention)
                @php
                    $convention = $timeslot->convention
                @endphp
                @include('calendar.conventions.conventionheader')
            @endisset

        <div style='font-size: 1.2em;'>
        @foreach($timeslot->convention->timeslots as $ts)
            
            @if($ts->id == $timeslot->id)
            <div style='font-size: 1.3em; display: inline;'>
                    {{$timeslot->title}}
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
                $timeslot->end_time()->format('g:ia')
            }}
        </small></h4>
        <hr>

        @if($timeslot->games->count())
            <div class="card">
                <div class="card-header">{{$timeslot->games->count()}} games scheduled.</div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($timeslot->games as $game)
                            <a href="/calendar/convention/gamesession/{{ $game->getGamesSession($game->id, $timeslot->id)->id}}" 
                                class="list-group-item list-group-item-action"> {{$game->title}} <br>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            No games scheduled.
        @endif
    </div>
</div>

@endsection