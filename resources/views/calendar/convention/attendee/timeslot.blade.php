@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-md-8 text-center text-md-left">
                <h5> <a href="/profile">{{$user->firstname}} {{$user->lastname}}</a> </h5>
            </div>
            <div class="col-md-4 text-center text-md-right"></div>
        </div>
        <div class="row mt-1">
            <div class="col-md-8 text-center text-md-left">
                <h5><small>{{$user->profile->description}}</small></h5>
            </div>
            <div class="col-md-4 text-center text-md-right"> </div>
        </div>  
    </div>
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                
                <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
                <li class="breadcrumb-item"> <a href="/calendar/convention/{{$convention->id}}/attendee/schedule">Convention Schedule</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Select Game</li>
            </ol>
        </nav>
        
        <div class="card">
            <div class="card-header">
                {{$convention->title}} Schedule
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 card-title">
                            <div class='lead'>
                                {{$timeslot->title}} <br>
                                <small>
                                {{$timeslot->pretty_times()}}<br>
                                
                            </small>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <ul class="list-group">

                            
                            @foreach($timeslot->games as $game)
                                
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-6">
                                            {{$game->title}}
                                        </div>
                                        <div class="col-3">
                                                Players: {{$timeslot->gamesession($game)->attendees->count()}} / {{$game->max}}
                                        </div>
                                        @if($user->gamesessions->where('timeslot_id' , $timeslot->id)->count())
                                            @if($user->gamesessions->where('timeslot_id' , $timeslot->id)->first()->game->id == $game->id)
                                                <div class="col-3 text-right">
                                                    <form 
                                                        action="{{ action('Calendar\AttendeeController@leaveGamesession' , $timeslot->gamesession($game)) }}" 
                                                        method="post">
                                                        @csrf
                                                        <button class="m-1 btn btn-sm btn-warning btn-block" type="submit">Leave</button>
                                                    </form> 
                                                </div>
                                            @else
                                            
                                        
                                            @endif

                                        @else

                                            @if( $timeslot->gamesession($game)->attendees->count() >= $game->max)
                                            <div class="col-3 text-center">
                                                    <strong>Full</strong>
                                                </div>
                                            @else
                                                <div class="col-3 text-right">
                                                    <form 
                                                        action="{{ action('Calendar\AttendeeController@attendGamesession' , $timeslot->gamesession($game)) }}" 
                                                        method="post">
                                                        @csrf
                                                        <button class="m-1 btn btn-sm btn-primary btn-block" type="submit">Play!</button>
                                                    </form> 
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                            </ul>
        
                            
    
                        </div>
                    </div>
            </div>
        </div>


@endsection