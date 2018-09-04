@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <h5><a href="/calendar/convention/{{$convention->id}}/manage">Manage {{$convention->title}}</h5></a>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <a href="/calendar/convention/{{$convention->id}}/manage" class=""><i class="material-icons text-with-icon">event</i></a>
                <div class="inline-block text-with-icon "><strong>Attendee Info</strong></div> 
            </div>
            <div class="body">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                           
                            <div class="row">
                                <div class="col-8">
                                    <div class="lead">{{$member->firstname}} {{$member->lastname}}</div>
                                </div>
                                <div class="col-4 text-right">
                                     

                                        <form 
                                            action="{{ action('Calendar\AttendeeController@remove')}}" 
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="convention" value="{{$convention->id}}">
                                            <input type="hidden" name="attendee" value="{{$member->id}}">
                                            <button class="m-1 btn btn-sm btn-danger btn-block" type="submit">Remove</button>
                                        </form> 
                                
                                </div>
                            </div>
                            
                        </div>
                       
                        @if($member->games->where('event_id' , $convention->id)->count())
                        <strong>Gamemaster for</strong>
                        <div class="card-deck mt-2">
                            @foreach($member->games->where('event_id' , $convention->id) as $game)
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <div class="lead ">
                                            <a href="/calendar/convention/game/{{$game->id}}/schedule" >
                                                {{$game->title}}
                                            </a>
                                        </div>
                                        
                                    </div>
                                    <ul class="list-group">
                                    @foreach($convention->timeslots as $timeslot)
                                        @if($timeslot->games->where('id' , $game->id)->count())
                                            <li class="list-group-item border-0">
                                                <small>{{$timeslot->title}} </small> <br>
                                                {{$timeslot->only_times()}}
                                            </li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                             
                        </div> 
                        @else
                            <em>No games</em>
                        @endif
                        <div class="row mt-2">
                            <div class="col text-center">
                                <a href="/calendar/convention/{{$convention->id}}/attendee/{{$member->id}}/game/new" 
                                    class="btn btn-sm btn-primary">
                                    Create a Game for {{$member->username}}</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        {{$member->username}}'s Convention Schedule
                                    </div>
                                    <div class="card-body">
                                        @foreach($convention->days() as $day)
                                            <div class="row">
                                                <div class="col-sm-3 col-md-2 text-left text-sm-right">
                                                    <div class="strong my-2">{{$day->format('l')}}</div>
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
                            
                                                                        @if($timeslot->games->where('user_id' , $member->id)->count())
                                                                            @php 
                                                                                $game = $timeslot->games->where('user_id' , $member->id)->first();
                                                                            @endphp
                                                                                
                                                                                
                                                                            <div class="col-md-9">
                                                                                <small>Scheduled to GM</small> <br>
                                                                                <a href="/calendar/convention/session/{{$timeslot->gamesession($game)->id}}"> <strong>{{$timeslot->games->where('user_id', $member->id )->first()->title}}</strong></a>
                                                                            </div>
                                                                            
                                                                        @else
                    
                                                                            @if($member->gamesessions->where('timeslot_id' , $timeslot->id)->first())
                                                                                <div class="col-md-5">
                                                                                <small>Scheduled to play</small> <br>
                                                                                    {{$member->gamesessions->where('timeslot_id' , $timeslot->id)->first()->game->title}}
                                                                                </div>
                                                                                <div class="col-md-4 text-center">
                                                                                        <a href="/calendar/convention/attendee/{{$member->id}}/timeslot/{{$timeslot->id}}" 
                                                                                            class="btn btn-sm btn-info btn-block" type="submit">Change</a>
                                                                                </div>
                                                                            @else
                                                                                <div class="col-md-5">
                                                                                    <em>No Game Selected</em>
                                                                                </div>
                                                                                <div class="col-md-4 text-center">
                                                                                    <a href="/calendar/convention/attendee/{{$member->id}}/timeslot/{{$timeslot->id}}" 
                                                                                        class="btn btn-sm btn-primary btn-block" type="submit">Pick a Game</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection