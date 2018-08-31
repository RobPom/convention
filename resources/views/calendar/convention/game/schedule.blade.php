@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
            <h5><a href="/calendar/convention/{{$convention->id}}/manage">Manage {{$convention->title}}</h5></a>
    </div>
    <div class="card-body">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <a href="/calendar/convention/{{$convention->id}}/pool" class=""><i class="material-icons text-with-icon">view_list</i></a>
                        <div class="inline-block text-with-icon "><strong>Game Schedule </strong></div> 
                    </div>
                    <div class="col-4 text-right">
                    <a href="/calendar/convention/game/{{$game->id}}/edit" class="btn btn-sm btn-primary ">edit</a>
                    
                </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7  pt-2">
                        <strong class="d-block">
                                
                            {{$game->title}}
                        </strong>
                        <div class="text-muted d-block">
                            {{$game->tagline}}
                        </div>
                        <p class='pt-2'>{{$game->lead}}</p>
                        <p>{!! $game->description !!}</p>
                        <div class="row">
                            <div class="col text-center small">
                                <strong>Gamemaster:</strong>
                                {{$game->user->username}}
                            </div>
                            <div class="col text-center small">
                                {{$game->min}} to {{$game->max}} players
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col text-center small">{{$game->advisory}}</div>
                            <div class="col text-center small">{{$game->system}}</div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card mt-4">
                            <div class="card-body">
                                @foreach($convention->days() as $day)
                                    @if ($loop->first) 
                                        <div class="mb-2"><strong>{{$day->format('l')}}</strong></div> 
                                    @else
                                        <div class="my-2"><strong>{{$day->format('l')}}</strong></div>
                                    @endif
  
                                    <ul class="list-group">
                                        
                                        @foreach($convention->timeslots()->orderBy('start_time', 'asc')->get() as $timeslot)
                                            @if($day->isSameDay($timeslot->start_time()) && $timeslot->accept_games)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-lg-4 col-6">
                                                        <strong>
                                                            {{$timeslot->title}} 
                                                        </strong>
                                                        
                                                    </div>
                                                    <div class="col-lg-4 col-6 text-center">
                                                       
                                                            <i class="material-icons text-with-icon">group</i>
                                                            <div class="inline-block text-with-icon small">##/12</div> 
                                                    
                                                    </div>
                                                    @if($timeslot->games->where('id' , $game->id)->first())
                                                    
                                                        <div class="col-lg-4  text-center">
                                                            <form
                                                                autocomplete="off"
                                                                onsubmit="return confirm('You cannot undo this. Are you sure you want to delete this game session?');" 
                                                                action="{{action('Calendar\ConventionController@removeFromTimeslot')}}" 
                                                                method="post">
                                                                @csrf
                                                                
                                                                <input type="hidden" value="{{$timeslot->id}}" name="timeslot">
                                                            <input type="hidden" value="{{$game->id}}" name="game">
                                                                <button class="btn btn-sm btn-danger btn-block" type="submit"><i class="material-icons text-with-icon">clear</i></button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                
                                                    @else
                                                    <div class="col-lg-4 text-center">
                                                        <form
                                                            autocomplete="off" 
                                                            action="{{action('Calendar\ConventionController@addToTimeslot')}}" 
                                                            method="post">
                                                            @csrf
                                                            
                                                            <input type="hidden" value="{{$timeslot->id}}" name="timeslot">
                                                            <input type="hidden" value="{{$game->id}}" name="game">
                                                            <button class="btn btn-sm btn-primary btn-block" type="submit"><i class="material-icons text-with-icon">add</i></button>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    @endif
                                                
                                            </li>

                                        @endif
                                    @endforeach
                                </ul>
                            @endforeach
                        </div>
                    </div>











                    </div>
                </div>

            </div>
        </div>
        
    </div>
</div>
@endsection