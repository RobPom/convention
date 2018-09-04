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
                <div class="inline-block text-with-icon "><strong>Attendee Schedule</strong></div> 
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="lead">{{$member->firstname}} {{$member->lastname}}</div>
                        </div>


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
                                                    #/# Players
                                                </div>
                                                @if($member->gamesessions->where('timeslot_id' , $timeslot->id)->count())
                                                    @if($member->gamesessions->where('timeslot_id' , $timeslot->id)->first()->game->id == $game->id)
                                                  
                                                        <div class="col-3 text-right">
                                                            <form 
                                                                action="{{ action('Calendar\AttendeeController@removeAttendeeGamesession' , $member->id) }}" 
                                                                method="post">
                                                                @csrf
                                                                
                                                                <input type="hidden" name="gamesession" value="{{$timeslot->gamesession($game)->id}}">
                                                                <input type="hidden" name="convention" value="{{$convention->id}}">
                                                                <button class="m-1 btn btn-sm btn-warning btn-block" type="submit">Leave</button>
                                                            </form> 
                                                        </div>
                                                    @else
                                                    <div class="col-3 text-right">
                                                        
                                                    </div>
                                                
                                                    @endif
        
                                                @else
                                                    <div class="col-3 text-right">
                                                        <form 
                                                            action="{{ action('Calendar\AttendeeController@addAttendGamesession' , $member->id) }}" 
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" name="gamesession" value="{{$timeslot->gamesession($game)->id}}">
                                                                <input type="hidden" name="convention" value="{{$convention->id}}">
                                                            <button class="m-1 btn btn-sm btn-primary btn-block" type="submit">Select</button>
                                                        </form> 
                                                    </div>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                    </ul>
                
                                    
            
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection