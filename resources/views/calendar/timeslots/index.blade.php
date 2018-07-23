@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-body">
        <h3>Timeslots</h3>


        @foreach($timeslots as $timeslot)
            <a href="/calendar/timeslot/{{$timeslot->id}}"> {{$timeslot->title}}</a>
            @if($timeslot->games->count())
                <ul>
                    @foreach($timeslot->games as $game)
                        <li><a href="/game/{{$game->id}}">
                                {{$game->title}}
                            </a>
                           
                            @php
                                $session = $game->gamesession($timeslot->id);
                            @endphp 

                            @if($session->attendees()->count())
                            | 
                                <small>
                                    @foreach($session->attendees as $attendee)
                                        {{$attendee->username}}  
                                    @endforeach
                                </small> 
                            @endif
                                  
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach

        
    </div>
</div>

        
@endsection