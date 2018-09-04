@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-md-8 text-center text-md-left">
                <h5> <a href="/profile">{{$user->firstname}} {{$user->lastname}}</a> </h5>
            </div>
            <div class="col-md-4 text-center text-md-right">
                
            </div>
        </div>
        <div class="row mt-1">

            <div class="col-md-8 text-center text-md-left">
                <h5><small>{{$user->profile->description}}</small></h5>
            </div>
            

            <div class="col-md-4 text-center text-md-right">
                
            </div>


        </div>  
    </div>
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="/profile">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Convention Schedule</li>
            </ol>
        </nav>
        
        <div class="card">
            <div class="card-header">
                {{$convention->title}} Schedule
            </div>
            <div class="card-body">
                    @foreach($convention->days() as $day)
                        <div class="row">
                            <div class="col-sm-3 col-md-2 text-left text-sm-right">
                                <div class="lead my-2">{{$day->format('l')}}</div>
                            </div>
                            <div class="col-sm-9 col-md-10">
                                <ul class="list-group my-2">
                                    @foreach($convention->timeslots()->orderBy('start_time', 'asc')->get() as $timeslot)
                                        @if($day->isSameDay($timeslot->start_time()) && $timeslot->accept_games)
                                            <li class="list-group-item ">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        {{$timeslot->title}}<br>
                                                        <small>{{$timeslot->only_times()}}</small>
                                                    </div>
        
                                                    @if($timeslot->games->where('user_id' , $user->id)->count())
                                                        @php 
                                                            $game = $timeslot->games->where('user_id' , $user->id)->first();
                                                        @endphp
                                                            
                                                            
                                                        <div class="col-md-9">
                                                            <small>You are scheduled to GM</small> <br>
                                                            <a href="/calendar/convention/session/{{$timeslot->gamesession($game)->id}}"> <strong>{{$timeslot->games->where('user_id', $user->id )->first()->title}}</strong></a>
                                                        </div>
                                                        
                                                    @else

                                                        @if($user->gamesessions->where('timeslot_id' , $timeslot->id)->first())
                                                            <div class="col-md-6">
                                                            <small>You are scheduled to play</small> <br>
                                                                {{$user->gamesessions->where('timeslot_id' , $timeslot->id)->first()->game->title}}
                                                            </div>
                                                            <div class="col-md-3 text-center">
                                                                    <a href="/calendar/convention/attendee/timeslot/{{$timeslot->id}}" class="btn btn-sm btn-info btn-block" type="submit">Change</a>
                                                            </div>
                                                        @else
                                                            <div class="col-md-6">
                                                                <em>No Game Selected</em>
                                                            </div>
                                                            <div class="col-md-3 text-center">
                                                                <a href="/calendar/convention/attendee/timeslot/{{$timeslot->id}}" class="btn btn-sm btn-primary btn-block" type="submit">Pick a Game</a>
                                                            </div>
                                                        @endif
                                                    @endif
 
                                                </div>
                                                
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        
                        </div>
                    @endforeach
                </div>
        </div>
    </div>

    
</div>

@endsection