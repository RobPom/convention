@extends('layouts.app')

@section('content')

@isset($timeslot->convention)
<div class="card">
    <div class="card-body">
        <h3>{{$timeslot->convention->title}}</h3>
    </div>
</div>
<br> 
@endisset


<div class="card">
    <div class="card-body">
        <h4>{{$timeslot->title}}</h4>
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