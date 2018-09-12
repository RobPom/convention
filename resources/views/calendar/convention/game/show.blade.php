@extends('layouts.app')

@section('content')

<div class="card p-2 border-0">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-md-8 text-center text-md-left">
                <h5> <a href="/calendar/convention/{{$convention->id}}">{{$convention->title}}</a> </h5>
            </div>
            <div class="col-md-4 text-center text-md-right">
                <small>{{$convention->pretty_dates()}}</small>
            </div>
        </div>
        <div class="row mt-1">

            <div class="col-md-8 text-center text-md-left">
                <h5><small>{{$convention->tagline}}</small></h5>
            </div>
            
            @auth
                @if( Auth::user()->hasRole('organizer') || Auth::user()->hasRole('admin')  )
                    @if($convention->status != 'archived')
                        <div class="col-md-4 text-right">
                            <a href="/calendar/convention/{{$convention->id}}/manage" class="btn btn-sm btn-primary">Manage</a>
                        </div>
                    @endif
                @endif
            @endauth

        </div>  
    </div>
    <div class="card-body">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item">
                    <a href="/calendar/convention/{{$convention->id}}">Convention</a>
                </li>
                <li class="breadcrumb-item"><a href="/calendar/convention/{{$convention->id}}/games">Games</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$game->title}}</li>
            </ol>
        </nav>
        
            <div class="card">
                <div class="card-header">
                <strong> Game</strong>
                </div>
                <div class="card-body">
                    
                    <div class="card-title">
                        <h5>{{$game->title}}</h5>
                        <h5><small>{{$game->tagline}}</small></h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 text-center">
                            @if($game->image == 'default.jpg')
                                <img class="img-fluid align-self-center pull-left mr-3 mb-2" 
                                    style="max-height:240px ;"
                                    src='/img/game_images/default.jpg'
                                    alt="Avatar Placeholder">
                            @else
                                <img class="img-fluid align-self-center mr-3 mb-2" 
                                    style="max-height:240px ;"
                                    src="/storage/uploads/game_images/{{$game->image}}"
                                    alt="Avatar Placeholder">
                            @endif
                        </div>
                        <div class="col-sm-9">
                            <div class="lead my-3">
                                {{$game->lead}}
                            </div>
                            {!!$game->description!!}
                        </div>
                    </div>

                   


                    @if($game->timeslots->count())
                        <div class="card m-4">
                            <div class="card-header">
                                Convention Schedule
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($game->timeslots as $timeslot)
                                    <div class="col-lg-6 col-xl-4">
                                        <a href="/calendar/convention/session/{{$timeslot->gamesession($game)->id}}" class='list-group-item list-group-item-active'>
                                            <div class="row">        
                                                <div class="col-sm-12 ">
                                                    <strong>{{$timeslot->title}}</strong>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <small class="text-muted">
                                                    {{$timeslot->pretty_times()}}
                                                </small>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <small>
                                                        <strong>Players: </strong> {{$timeslot->gamesession($game)->attendees->count()}} / {{$game->max}} 
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <strong>Gamemaster: </strong>
                            {{$game->user->username}}
                        </div>
                        <div class="col">
                            {{$game->system}}
                        </div>
                        <div class="col">
                            {{$game->max}} Players
                        </div>
                    </div>
                </div>
    
            </div>
           
        </div>
    </div>
</div>
@endsection