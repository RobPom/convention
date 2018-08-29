@extends('layouts.app')

@section('content')

<div class="card p-2">
    <div class="card-header bg-white">
        <h5>Manage {{$convention->title}}</h5>
    </div>
    <div class="card-body">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <strong> Edit Game Schedule </strong>
                    </div>
                    <div class="col-4 text-right">
                        <a href="/calendar/convention/game/{{$game->id}}/edit" class="btn btn-sm btn-primary ">edit game</a></div>
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
                        <div class="card">
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
                                                    <div class="col-sm-4 text-center">
                                                        {{$timeslot->title}} 
                                                    </div>
                                                @if($timeslot->games->where('id' , $game->id)->first())
                                                    <div class="col-sm-4 text-center">
                                                        scheduled
                                                    </div>
                                                    <div class="col-sm-4 text-center"><a href="" class="btn btn-sm btn-danger">remove</a> </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <strong>players: </strong>
                                                    </div>
                                                </div>
                                            
                                                @else
                                                <div class="col-sm-4 text-center">
                                                    
                                                </div>
                                                <div class="col-sm-4 text-center">
                                                    <a href="" class="btn btn-sm btn-primary">Add</a>
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